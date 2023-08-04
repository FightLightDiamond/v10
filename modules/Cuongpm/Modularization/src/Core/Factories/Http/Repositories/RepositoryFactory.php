<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 5/25/17
 * Time: 3:59 PM
 */

namespace Cuongpm\Modularization\Core\Factories\Http\Repositories;

use Cuongpm\Modularization\Core\Components\Http\Repositories\RepositoryComponent;
use Cuongpm\Modularization\Core\Factories\_Interface;
use Cuongpm\Modularization\Core\Factories\BaseFactory;

class RepositoryFactory extends BaseFactory implements _Interface
{
    protected $component;
    protected $sortPath = '/Http/Repositories/';
    protected $fileName = 'RepositoryEloquent.php';

    public function __construct(RepositoryComponent $component)
    {
        $this->component = $component;
    }

    public function building($table, $namespace = 'App\\', $path = 'app')
    {
        $this->table = $table;
        $material = $this->component->building($table, $namespace);
        $this->produce($material, $path, false);
    }
}
