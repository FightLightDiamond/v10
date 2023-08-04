<?php
/**
 * Created by cuongpm/modularization.
 * User: mac
 * Date: 9/25/18
 * Time: 5:54 PM
 */

namespace Cuongpm\Modularization\Core\Factories\Http\Resources;


use Cuongpm\Modularization\Core\Components\Http\Resources\ResourceComponent;
use Cuongpm\Modularization\Core\Factories\BaseFactory;
use Cuongpm\Modularization\Core\Components\Http\Resources\ResourceCollectionComponent;

class ResourceFactory extends BaseFactory
{
    protected $component;
    protected $collectionComponent;

    protected $auth = 'API';
    protected $sortPath = '/Http/Resources/';
    protected $fileName = 'Resource.php';

    public function __construct(ResourceComponent $component, ResourceCollectionComponent $collectionComponent)
    {
        $this->component = $component;
        $this->collectionComponent = $collectionComponent;
    }

    public function building($params)
    {
        $this->table = $params['table'];

        $material = $this->component->building($params, $this->auth);
        $this->produce($material, $params['path']);

        $this->fileName = 'ResourceCollection.php';
        $material = $this->collectionComponent->building($params, $this->auth);
        $this->produce($material, $params['path']);
    }
}
