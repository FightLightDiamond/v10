<?php

namespace Cuongpm\Modularization\Console\Commands\Modules;

use Illuminate\Console\Command;
use Cuongpm\Modularization\Core\Factories\Http\Services\ServiceFactory;
use Cuongpm\Modularization\Http\Facades\DBFa;

class ServiceModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:service {table?} {--namespace=App\}  {--path=app/}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $serviceFactory;

    public function __construct(ServiceFactory $serviceFactory)
    {
        parent::__construct();

        $this->serviceFactory = $serviceFactory;
    }

    public function handle()
    {
        $table = $this->argument('table') ?? '*';
        $namespace = $this->option('namespace') . "\\";
        $path = $this->option('path');

        if($table === '*') {
            $tables = DBFa::table($dbName = null);
        } else {
            $tables = [$table];
        }

        $params = compact('table', 'namespace', 'path');

        foreach ($tables as $table) {
            $params['table'] = $table;
            $this->serviceFactory->building($params);
        }
    }
}
