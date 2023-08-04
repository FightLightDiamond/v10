<?php
/**
 * Created by cuongpm/modularization.
 * User: mac
 * Date: 10/20/18
 * Time: 9:42 AM
 */

namespace Cuongpm\Modularization\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Cuongpm\Modularization\Core\Components\Http\Controllers\APICtrlComponent;
use Cuongpm\Modularization\Core\Factories\Http\Controllers\APICtrlFactory;
use Cuongpm\Modularization\Core\Factories\Http\Repositories\InterfaceFactory;
use Cuongpm\Modularization\Core\Factories\Http\Repositories\RepositoryFactory;
use Cuongpm\Modularization\Core\Factories\Http\Resources\ResourceFactory;
use Cuongpm\Modularization\Core\Factories\Http\Services\ServiceFactory;
use Cuongpm\Modularization\Core\Factories\Models\ModelFactory;
use Cuongpm\Modularization\Core\Factories\Polices\PolicyFactory;
use Cuongpm\Modularization\Core\Factories\Routers\RouteAPIFactory;
use Cuongpm\Modularization\Core\Factories\Routers\RouterFactory;
use Cuongpm\Modularization\Core\Factories\ServiceProviderFactory;

class APICtrlController
{
    private $APICtrlFactory, $resourceFactory, $routeAPIFactory;

    public function __construct(
        APICtrlFactory $APICtrlFactory,
        ResourceFactory $resourceFactory,
        RouteAPIFactory $routeAPIFactory
    ) {
        $this->APICtrlFactory = $APICtrlFactory;
        $this->resourceFactory = $resourceFactory;
        $this->routeAPIFactory = $routeAPIFactory;
    }

    public function produce($params)
    {
        $prefix = $params['prefix'];
        $params = $this->fix($params);
        $table = $params['table'];
        $namespace = $params['namespace'];
        $path = $params['path'];

        $this->APICtrlFactory->building($params);
        $this->resourceFactory->building($params);
        $this->routeAPIFactory->building($params['namespace'], $params['path']);

        if(isset($params['provider'])) {
            app(ServiceProviderFactory::class)->building($namespace, $path, $prefix);
        }
        if(isset($params['controller'])) {
            app(APICtrlComponent::class)->building($params);
        }
        if(isset($params['repository'])) {
            app(RepositoryFactory::class)->building($table, $namespace, $path);
            app(InterfaceFactory::class)->building($table, $namespace, $path);
        }
        if(isset($params['model'])) {
            app(ModelFactory::class)->building($table, $namespace, $path);
        }
        if(isset($params['request'])) {
            app(RepositoryFactory::class)->building($table, $namespace, $path);
        }
        if(isset($params['policy'])) {
            app(PolicyFactory::class)->building($table, $namespace, $path);
        }
        if(isset($params['route'])) {
            app(RouterFactory::class)->building($namespace, $path);
        }
        if(isset($params['service'])) {
            app(ServiceFactory::class)->building($params);
        }
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $params = $this->fix($params);
        $table = $params['table'];

        $this->produce($params);
        $mgs = $this->buildRoute($params['namespace']) . $this->buildMessage($table);
        session()->flash('success', $mgs);

        return redirect()->back()->withInput($params);
    }

    private function buildMessage($table)
    {
        $name = Str::ucfirst(Str::camel(Str::singular($table)));
        $route = Str::kebab(Str::camel(($table)));
        $mgs = "Route::resource('{$route}' , '{$name}APIController'); \n";
        $mgs .= '$this->app->bind(' . $name . 'Repository::class, ' . $name . 'RepositoryEloquent::class);' . " \n";
        return $mgs;
    }

    private function buildRoute($namespace)
    {
        return "Route::name('api.')
            ->namespace('{$namespace}Http\Controllers\API')
            ->prefix('api')
            ->middleware(['api'])
            ->group( function () {

            });";
    }

    private function fix($params)
    {
        $path = $params['path'];

        try {
            mkdir(base_path($path));
        } catch (\Exception $exception) {
            logger($exception);
        }

        $params['table'] = isset($params['table']) ? $params['table'] : 'users';
        $params['path'] = isset($params['path']) ? $params['path'] : 'app';
        $params['namespace'] = isset($params['namespace']) ? $params['namespace'] : 'App\\';
        $params['prefix'] = isset($params['prefix']) ? $params['prefix'] . '::' : '';
        $params['route'] = Str::kebab(Str::camel(($params['table'])));
        $params['viewFolder'] = Str::kebab(Str::camel(Str::singular($params['table'])));
        return $params;
    }
}
