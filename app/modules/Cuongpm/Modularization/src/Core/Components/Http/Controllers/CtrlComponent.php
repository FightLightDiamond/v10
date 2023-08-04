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

    public function building($input)
    {
        $this->buildNameSpace($input['namespace']);
        $this->buildClassName($input['table']);
        $this->buildTable($input['table']);
        $this->buildVariable($input['table']);
        $this->buildView($input['table'], $input['prefix']);
        $this->buildVariables($input['table']);
        $this->buildRoute($input['route']);
        return $this->source;
    }

    private function getSource()
    {
        return $this->getCtrlPath( '/controller.txt');
    }
}
