<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * Date: 5/8/19
 * Time: 2:29 PM
 */

namespace Cuongpm\Modularization\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Cuongpm\Modularization\Core\Factories\Http\Repositories\InterfaceFactory;
use Cuongpm\Modularization\Core\Factories\Http\Repositories\RepositoryFactory;
use Cuongpm\Modularization\Core\Factories\Http\Requests\RequestFactory;
use Cuongpm\Modularization\Core\Factories\Http\Services\ServiceFactory;
use Cuongpm\Modularization\Core\Factories\Models\ModelFactory;
use Cuongpm\Modularization\Core\Factories\Polices\PolicyFactory;
use Cuongpm\Modularization\Core\Factories\Routers\RouterFactory;
use Cuongpm\Modularization\Core\Factories\ServiceProviderFactory;
use Cuongpm\Modularization\Http\Facades\DBFa;
use Cuongpm\Modularization\Core\Factories\Tests\Feature\FeatureTestFactory;
use Cuongpm\Modularization\Helpers\BuildInput;

class RenderController extends Controller
{
    public function create()
    {
        $tables = DBFa::table();
        $name = \request('name');

        if ($name) {
            foreach ($tables as $k => $table) {
                if (strpos($table, $name) === false) {
                    unset($tables[$k]);
                }
            }
        }

        $options = [
            'controller', 'model', 'repository', 'view', 'request', 'policy', 'service', 'route', 'provider', 'test'
        ];

        $optionAPIs = [
            'controller', 'model', 'repository', 'resource', 'request', 'policy', 'service', 'route', 'provider', 'test'
        ];

        return view('mod::module.create', compact('tables', 'options', 'optionAPIs'));
    }

    public function extraRender($params)
    {
        $prefix = $params['prefix'];
        $table = $params['table'];
        $namespace = $params['namespace'];
        $path = $params['path'];
        $class = $params['class'];

        if (request()->provider && request()->provider !== 'App\\') {
            app(ServiceProviderFactory::class)->building($namespace, $path, $prefix);
        }
        if (request()->repository) {
            app(RepositoryFactory::class)->building($table, $namespace, $path);
            app(InterfaceFactory::class)->building($table, $namespace, $path);
        }
        if (request()->model) {
            app(ModelFactory::class)->building($table, $namespace, $path);
        }
        if (request()->request) {
            app(RequestFactory::class)->building($table, $namespace, $path);
        }
        if (request()->policy) {
            app(PolicyFactory::class)->building($table, $namespace, $path);
        }
        if (request()->route && request()->provider !== 'App\\') {
            app(RouterFactory::class)->building($namespace, $path);
        }
        if (request()->service) {
            app(ServiceFactory::class)->building($params);
        }
        if (request()->test) {
            app(FeatureTestFactory::class)->building($params);
        }
        if (request()->seed) {
            Artisan::call("make:seeder {$class}Seeder");
            Artisan::call("make:factory {$class}Factory --model={$class}");
        }
    }

    public function fix($params)
    {
        $path = $params['path'];

        try {
            mkdir(base_path($path));
        } catch (\Exception $exception) {
            logger($exception);
        }

        $table = isset($params['table']) ? $params['table'] : 'users';

        $params['table'] = $table;
        $params['path'] = isset($params['path']) ? $params['path'] : 'app';
        $params['namespace'] = isset($params['namespace']) ? $params['namespace'] : "App\\";
        $params['prefix'] = isset($params['prefix']) ? $params['prefix'] . '::' : '';
        $params['route'] = BuildInput::route($table);
        $params['viewFolder'] = Str::kebab(Str::camel(Str::singular($table)));

        $params['class'] = BuildInput::classe($table);

        return $params;
    }

}
