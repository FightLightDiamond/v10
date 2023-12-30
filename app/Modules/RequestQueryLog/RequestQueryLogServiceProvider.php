<?php

namespace App\Modules\RequestQueryLog;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class RequestQueryLogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        DB::listen(function($query) {
            Log::channel('rql')->info(
                $query->sql,
                [
                    'bindings' => $query->bindings,
                    'time' => $query->time
                ]
            );
        });
    }
}
