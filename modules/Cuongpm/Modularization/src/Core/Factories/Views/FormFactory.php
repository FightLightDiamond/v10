<?php
/**
 * Created by cuongpm/modularization.
 * Author: Fight Light Diamond i.am.m.cuong@gmail.com00
 * Date: 11/2/2016
 * Time: 9:24 AM
 */

namespace Cuongpm\Modularization\Core\Factories\Views;

use Cuongpm\Modularization\Core\Components\Views\CreateFormComponent;
use Cuongpm\Modularization\Core\Components\Views\IndexFormComponent;
use Cuongpm\Modularization\Core\Components\Views\ShowFormComponent;
use Cuongpm\Modularization\Core\Components\Views\TableFormComponent;
use Cuongpm\Modularization\Core\Components\Views\UpdateFormComponent;

/**
 * Class FormFactory
 * Đối tượng form được sản xuất tại đây
 * Nơi sản xuất các thành phần component
 * Các
 *
 * @package Cuongpm\Modularization\Core\Factories
 */
class FormFactory
{
    protected $component, $packet;

    private $creating, $updating, $showing, $indexing, $tabling;

    public function __construct(
        CreateFormComponent $creating,
        UpdateFormComponent $updating,
        ShowFormComponent $showing,
        TableFormComponent $tabling,
        IndexFormComponent $indexing
    ) {
        $this->creating = $creating;
        $this->updating = $updating;
        $this->showing = $showing;
        $this->tabling = $tabling;
        $this->indexing = $indexing;
    }

    private $path = 'app';


    private function getSourceCreateForm($table, $path = 'app')
    {
        return base_path($path . '/' . $table . '/create.blade.php');
    }

    private function outTableForm($table, $path = 'app')
    {
        return base_path($path . '/' . $table . '/table.blade.php');
    }

    static function outIndexForm($table, $path = 'app')
    {
        return base_path($path . '/' . $table . '/index.blade.php');
    }


    static function outUpdateForm($table, $path = 'app')
    {
        return base_path($path . '/' . $table . '/update.blade.php');
    }

    static function outShowForm($table, $path = 'app')
    {
        return base_path($path . '/' . $table . '/show.blade.php');
    }

    private function buildCreate($params)
    {
        $material = $this->creating->building($params);
        $fileForm = fopen($this->getSourceCreateForm($params['viewFolder'], $this->path), "w");
        fwrite($fileForm, $material);
    }

    private function buildTable($params)
    {
        $material = $this->tabling->building($params);
        $fileForm = fopen($this->outTableForm($params['viewFolder'], $this->path), "w");
        fwrite($fileForm, $material);
    }

    private function buildIndex($params)
    {
        $material = $this->indexing->building($params);
        $fileForm = fopen($this->outIndexForm($params['viewFolder'], $this->path), "w");
        fwrite($fileForm, $material);
    }

    private function buildUpdate($params)
    {
        $material = $this->updating->building($params);
        $fileForm = fopen($this->outUpdateForm($params['viewFolder'], $this->path), "w");
        fwrite($fileForm, $material);
    }

    private function buildShow($params)
    {
        $material = $this->showing->building($params);
        $fileForm = fopen($this->outShowForm($params['viewFolder'], $this->path), "w");
        fwrite($fileForm, $material);
    }

    public function building($params)
    {
        $this->checkPath($params);
        $this->buildCreate($params);
        $this->buildShow($params);
        $this->buildUpdate($params);
        $this->buildTable($params);
        $this->buildIndex($params);
    }

    private function checkPath($params)
    {
        $path = $params['path'];
        try {
            mkdir(base_path($path), 0755, true);
        } catch (\Exception $exception) {
            echo ($exception->getMessage()) . '</br>';
        }
        try {
            mkdir(base_path($path . '/resources'), 0755, true);
        } catch (\Exception $exception) {
            echo ($exception->getMessage()) . '</br>';
        }
        try {
            mkdir(base_path($path . '/resources/views'), 0755, true);
        } catch (\Exception $exception) {
            echo ($exception->getMessage()) . '</br>';
        }
        try {
            mkdir(base_path($path . '/resources/views/' . $params['viewFolder']), 0755, true);
        } catch (\Exception $exception) {
            echo ($exception->getMessage()) . '</br>';
        }
        $this->path = $path . '/resources/views';
    }
}
