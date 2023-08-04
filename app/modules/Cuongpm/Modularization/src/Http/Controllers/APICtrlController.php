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
    )
    {
        $this->APICtrlFactory = $APICtrlFactory;
        $this->resourceFactory = $resourceFactory;
        $this->routeAPIFactory = $routeAPIFactory;
    }

    public function produce($input)
    {
        $prefix = $input['prefix'];
        $input = $this->fix($input);
        $table = $input['table'];
        $namespace = $input['namespace'];
        $path = $input['path'];

        $this->APICtrlFactory->building($input);
        $this->resourceFactory->building($input);
        $this->routeAPIFactory->building($input['namespace'], $input['path']);

        if(isset($input['provider'])) {
            app(ServiceProviderFactory::class)->building($namespace, $path, $prefix);
        }
        if(isset($input['controller'])) {
            app(APICtrlComponent::class)->building($input);
        }
        if(isset($input['repository'])) {
            app(RepositoryFactory::class)->building($table, $namespace, $path);
            app(InterfaceFactory::class)->building($table, $namespace, $path);
        }
        if(isset($input['model'])) {
            app(ModelFactory::class)->building($table, $namespace, $path);
        }
        if(isset($input['request'])) {
            app(RepositoryFactory::class)->building($table, $namespace, $path);
        }
        if(isset($input['policy'])) {
            app(PolicyFactory::class)->building($table, $namespace, $path);
        }
        if(isset($input['route'])) {
            app(RouterFactory::class)->building($namespace, $path);
        }
        if(isset($input['service'])) {
            app(ServiceFactory::class)->building($input);
        }
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input = $this->fix($input);
        $table = $input['table'];

        $this->produce($input);
        $mgs = $this->buildRoute($input['namespace']) . $this->buildMessage($table);
        session()->flash('success', $mgs);

        return redirect()->back()->withInput($input);
    }

    private function buildMessage($table)
    {
        $name = Str::ucfirst(Str::camel(Str::singular($table)));
        $route = Str::kebab(Str::camel(($table)));
        $mgs = "Route::resource('{$route}' , '{$name}APIController'); \n";
        $mgs .= '$this->app->bind(' . $name . 'Repository::class, ' . $name . 'RepositoryEloquent::class);' . " \n";
        return $mgs;
    }

    private function buildRoute($namespace) {
        return "Route::name('api.')
            ->namespace('{$namespace}Http\Controllers\API')
            ->prefix('api')
            ->middleware(['api'])
            ->group( function () {
                
            });";
    }

    private function fix($input)
    {
        $path = $input['path'];

        try {
            mkdir(base_path($path));
        } catch (\Exception $exception) {
            logger($exception);
        }

        $input['table'] = isset($input['table']) ? $input['table'] : 'users';
        $input['path'] = isset($input['path']) ? $input['path'] : 'app';
        $input['namespace'] = isset($input['namespace']) ? $input['namespace'] : 'App\\';
        $input['prefix'] = isset($input['prefix']) ? $input['prefix'] . '::' : '';
        $input['route'] = Str::kebab(Str::camel(($input['table'])));
        $input['viewFolder'] = Str::kebab(Str::camel(Str::singular($input['table'])));
        return $input;
    }
}
