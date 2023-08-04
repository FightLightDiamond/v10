<?php

namespace App\Providers;

use Cuongpm\Modularization\ModularizationServiceProvider;
use Cuongpm\Uploader\UploadServiceProvider;
use English\EnglishServiceProvider;
use Illuminate\Support\ServiceProvider;
use Tutorial\TutorialServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
        $this->app->register(RepositoryProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->register(UploadServiceProvider::class);
        $this->app->register(ModularizationServiceProvider::class);
        $this->app->register(EnglishServiceProvider::class);
        $this->app->register(TutorialServiceProvider::class);
    }
}
