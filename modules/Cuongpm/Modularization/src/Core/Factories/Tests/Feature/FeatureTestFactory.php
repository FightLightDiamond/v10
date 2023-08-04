<?php
/**
 * Created by cuongpm/modularization.
 * Date: 8/3/19
 * Time: 3:26 PM
 */

namespace Cuongpm\Modularization\Core\Factories\Tests\Feature;


use Cuongpm\Modularization\Core\Factories\BaseFactory;
use Cuongpm\Modularization\Core\Components\Tests\Feature\FeatureTestComponent;

class FeatureTestFactory extends BaseFactory
{
    protected $component;
    protected $auth = 'API';
    protected $sortPath = 'Tests/Feature/';
    protected $fileName = 'Test.php';

    public function __construct(FeatureTestComponent $component)
    {
        $this->component = $component;
    }

    public function building($params)
    {
        $this->table = $params['table'];
        $path = $params['path'];

        $material = $this->component->building($params, $this->auth);
        $this->produce($material, $path);
    }
}
