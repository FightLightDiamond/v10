<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 11/2/2016
 * Time: 9:24 AM
 */

namespace Cuongpm\Modularization\Core\Factories\Models;

use Cuongpm\Modularization\Core\Components\Models\MutatorComponent;
use Cuongpm\Modularization\Core\Factories\_Interface;
use Cuongpm\Modularization\Http\Facades\FormatFa;

class MutatorFactory implements _Interface
{
    protected $component, $packet;

    public function __construct(MutatorComponent $component)
    {
        $this->component = $component;
    }

    public function produce($table, $material, $path = 'app')
    {
        $fileForm = fopen($this->getSource($table, $path), "w");
        fwrite($fileForm, $material);
    }

    public function getSource($table, $path = 'app')
    {
        if (!is_dir(base_path($path . '/Models'))) {
            mkdir(base_path($path . '\Models'));
        }
        return base_path($path . '/Models/' . FormatFa::formatAppName($table) . 'Mutator.php');
    }

    public function building($table, $namespace = 'App\\', $path = 'app')
    {
        $material = $this->component->building($table, $namespace);
        $this->produce($table, $material);
    }
}
