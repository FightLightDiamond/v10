<?php
/**
 * Created by cuongpm/modularization.
 * User: mac
 * Date: 9/25/18
 * Time: 5:55 PM
 */

namespace Cuongpm\Modularization\Core\Components\Http\Controllers;


use Cuongpm\Modularization\Core\Components\BaseComponent;

class APICtrlComponent extends  BaseComponent
{
    public function building($params)
    {
        $inPath = $this->getSource();
        $this->source = file_get_contents($inPath);

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
        return $this->getCtrlPath('/API/controller.txt');
    }
}
