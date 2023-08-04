<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 11/4/2016
 * Time: 4:49 PM
 */

namespace Cuongpm\Modularization\Http\Controllers;

use App\Http\Controllers\Controller;
use Cuongpm\Modularization\Core\Factories\Models\AccessorFactory;
use Illuminate\Support\Facades\View;

class AccessorController extends Controller
{
    protected $factory;

    public function __construct(AccessorFactory $factory)
    {
        $this->factory = $factory;
    }

    public function produce($table = 'users')
    {
        $this->factory->building($table);
        $this->show($table);
    }

    public function show($table = 'users')
    {
        echo $this->factory->getSource($table);
        echo '<pre>';
        echo file_get_contents($this->factory->getSource($table));
    }

    public function view($table)
    {
        if (View::exists($table)) {
            return view('models.accessor-' . $table);
        }
        return abort(404, 'Views not found');
    }
}
