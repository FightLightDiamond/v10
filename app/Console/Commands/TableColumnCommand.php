<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class TableColumnCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'table:column {table} {name=""}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $table = $this->argument('table');
        $name = $this->argument('name');
        $columns = Schema::getColumnListing($table);
        if ($name == '""') {
            foreach ($columns as $column) {
                echo $column . "\n";
            }
        } else {
            foreach ($columns as $column) {
                if (strpos($column, $name) !== false) {
                    echo $column . "\n";
                }
            }
        }
    }
}
