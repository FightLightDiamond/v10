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
    )
    {
        $this->APICtrlFactory = $APICtrlFactory;
        $this->resourceFactory = $resourceFactory;
        $this->routeAPIFactory = $routeAPIFactory;
    }

    public function produce($inputFix)
    {
        $inputFix = $this->fix($inputFix);

        $this->APICtrlFactory->building($inputFix);
        $this->resourceFactory->building($inputFix);
        $this->routeAPIFactory->building($inputFix['namespace'], $inputFix['path']);
        $this->extraRender($inputFix);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $inputFix = $this->fix($input);
        $table = $inputFix['table'];
        $this->produce($inputFix);
        $moduleContent = $this->buildRoute($inputFix['namespace']) . "\n\n" . $this->buildMessage($table);

        session()->flash('moduleContent', $moduleContent);

        return redirect()->back()->withInput($input);
    }

    private function buildMessage($table)
    {
        $name = BuildInput::name($table);
        $route = BuildInput::route($table);
        $mgs = "Route::resource('{$route}', '{$name}APIController'); \n\n";
        $mgs .= '$this->app->bind(' . $name . 'Repository::class, ' . $name . 'RepositoryEloquent::class);' . " \n";

        return $mgs;
    }

    private function buildRoute($namespace) {
        return
            "Route::name('api.')
                ->namespace('{$namespace}Http\Controllers\API')
                ->prefix('api')
                ->middleware(['api'])
                ->group( function () {
                    
                });";
    }
}
