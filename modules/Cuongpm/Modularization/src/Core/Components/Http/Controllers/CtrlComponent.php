<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 5/25/17
 * Time: 4:02 PM
 */

namespace Cuongpm\Modularization\Core\Components\Http\Controllers;

use Cuongpm\Modularization\Core\Components\BaseComponent;

class CtrlComponent extends BaseComponent
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
        return $this->getCtrlPath('/controller.txt');
    }
}
