<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 5/23/17
 * Time: 3:33 PM
 */

namespace Cuongpm\Modularization\Core\Components\Views;


use Cuongpm\Modularization\Core\Components\BaseComponent;
use Cuongpm\Modularization\Helpers\DecoHelper;

class IndexFormComponent extends BaseComponent
{
    public function __construct()
    {
        $this->source = file_get_contents($this->getSource());
    }

    private function getSource()
    {
        return ($this->getViewPath('/form/index.html'));
    }

    protected function buildExtend()
    {
        $this->working(DecoHelper::EXTENDS, config('modularization.extends'));
    }

    protected function buildContent()
    {
        $this->working(DecoHelper::CONTENT, config('modularization.content'));
    }

    public function building($params)
    {
        $this->buildNameSpace($params['namespace']);
        $this->buildContent();
        $this->buildExtend();

        $this->buildTable($params['table']);
        $this->buildRoute($params['route']);
        $this->buildView($params['table'], $params['prefix']);

        $this->buildVariable($params['table']);
        $this->buildVariables($params['table']);

        return $this->source;
    }
}
