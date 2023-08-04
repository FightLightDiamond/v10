<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * Date: 5/8/19
 * Time: 2:23 PM
 */

namespace Cuongpm\Modularization\Core\Components\Http\Controllers;


use Cuongpm\Modularization\Core\Components\BaseComponent;

class AdminCtrlComponent extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents($this->getSource());
    }

    public function building($params)
    {
        $this->buildNameSpace($params['namespace']);
        $this->buildClassName($params['table']);
        $this->buildTable($params['table']);
        $this->buildVariable($params['table']);
        $this->buildView($params['table'], $params['prefix']);
        $this->buildVariables($params['table']);
        $this->buildRoute($params['route']);
        return $this->source;
    }

    private function getSource()
    {
        return $this->getCtrlPath('/Admin/controller.txt');
    }
}
