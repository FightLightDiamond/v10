<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com
 * MIT: 2e566161fd6039c38070de2ac4e4eadd8024a825
 * Time: 1:26 PM
 */

namespace Cuongpm\Modularization\Core\Factories\Http\Services;

use Cuongpm\Modularization\Core\Components\Http\Services\ServiceComponent;
use Cuongpm\Modularization\Core\Factories\_Interface;
use Cuongpm\Modularization\Core\Factories\BaseFactory;

class ServiceFactory extends BaseFactory implements _Interface
{
    protected $component;
    protected $auth = 'API';
    protected $sortPath = 'Http/Services';
    protected $fileName = 'Service.php';

    public function __construct(ServiceComponent $component)
    {
        $this->component = $component;
    }

    public function building($params)
    {
        $this->table = $params['table'];
        $material = $this->component->building($params, $this->auth);
        $this->produce($material, $params['path']);
    }
}
