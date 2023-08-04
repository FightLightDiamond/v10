<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 5/25/17
 * Time: 4:03 PM
 */

namespace Cuongpm\Modularization\Core\Components\Http\Requests;

use Illuminate\Support\Str;
use Cuongpm\Modularization\Core\Components\BaseComponent;
use Cuongpm\Modularization\Http\Facades\DBFa;
use Cuongpm\Modularization\Helpers\DecoHelper;

class RequestComponent extends BaseComponent
{
    private $fields;

    protected function buildRule($table)
    {
        $this->fields = DBFa::getFillable($table);
        $rules = '';

        foreach ($this->fields as $field) {
            $rules .= "'{$field}' => 'required',\n";
        }

        $this->working(DecoHelper::RULE, $rules);
    }

    protected function buildMessage()
    {
        $this->working(DecoHelper::MESSAGE, '');
    }

    public function building($table, $action, $namespace = 'App\\', $auth = 'API')
    {
        $material = $this->getSource($auth);
        $this->source = file_get_contents($material);

        $this->buildNameSpace($namespace);
        $this->buildRule($table);
        $this->buildMessage();
        $this->buildClassName(RequestComponent . phpStr::singular($table) . $action);

        return $this->source;
    }

    private function getSource($auth)
    {
        return $this->getRequestPath( "/{$auth}/request.txt");
    }
}
