<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * Date: 5/8/19
 * Time: 2:28 PM
 */

namespace Cuongpm\Modularization\Http\Controllers\Group;


use Illuminate\Http\Request;
use Cuongpm\Modularization\Core\Factories\Http\Controllers\APICtrlFactory;
use Cuongpm\Modularization\Core\Factories\Http\Resources\ResourceFactory;
use Cuongpm\Modularization\Core\Factories\Routers\RouteAPIFactory;
use Cuongpm\Modularization\Helpers\BuildInput;

class APIController extends RenderController
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

    public function produce($paramsFix)
    {
        $paramsFix = $this->fix($paramsFix);

        $this->APICtrlFactory->building($paramsFix);
        $this->resourceFactory->building($paramsFix);
        $this->routeAPIFactory->building($paramsFix['namespace'], $paramsFix['path']);
        $this->extraRender($paramsFix);
    }

    public function store(Request $request)
    {
        $params = $request->all();
        $paramsFix = $this->fix($params);
        $table = $paramsFix['table'];
        $this->produce($paramsFix);
        $moduleContent = $this->buildRoute($paramsFix['namespace']) . "\n\n" . $this->buildMessage($table);

        session()->flash('moduleContent', $moduleContent);

        return redirect()->back()->withInput($params);
    }

    private function buildMessage($table)
    {
        $name = BuildInput::name($table);
        $route = BuildInput::route($table);
        $mgs = "Route::resource('{$route}', '{$name}APIController'); \n\n";
        $mgs .= '$this->app->bind(' . $name . 'Repository::class, ' . $name . 'RepositoryEloquent::class);' . " \n";

        return $mgs;
    }

    private function buildRoute($namespace)
    {
        return
            "Route::name('api.')
                ->namespace('{$namespace}Http\Controllers\API')
                ->prefix('api')
                ->middleware(['api'])
                ->group( function () {

                });";
    }
}
