<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 4/30/17
 * Time: 12:56 AM
 */

namespace Cuongpm\Modularization\Core\Factories\Observers;

use Illuminate\Support\Str;
use Cuongpm\Modularization\Core\Components\Observers\ObserverComponent;
use Cuongpm\Modularization\Core\Factories\_Interface;

class ObserverFactory implements _Interface
{
    private $component;

    public function __construct(ObserverComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path = 'app')
    {
        $fileForm = fopen($this->getSource($table, $path), "w");
        fwrite($fileForm, $material);
    }

    private function getSource($table, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Observers'))) {
            mkdir(base_path($path . '\Observers'));
        }
        return app_path('Observers/' . Str::ucfirst(Str::singular($table)) . 'Observer.php');
    }

    public function building($table, $namespace = 'App\\', $path = 'app')
    {
        $material = $this->component->building($table, $namespace);
        $this->produce($table, $material, $path);
    }
}
