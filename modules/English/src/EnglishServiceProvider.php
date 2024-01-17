<?php
/**
 * Created by PhpStorm.
 * User: CPM
 * Date: 6/12/2018
 * Time: 10:19 PM
 */

namespace English;

use English\Http\Repositories\CrazyCourseRepository;
use English\Http\Repositories\CrazyCourseRepositoryEloquent;
use English\Http\Repositories\CrazyDetailRepository;
use English\Http\Repositories\CrazyDetailRepositoryEloquent;
use English\Http\Repositories\CrazyHistoryRepository;
use English\Http\Repositories\CrazyHistoryRepositoryEloquent;
use English\Http\Repositories\CrazyRepository;
use English\Http\Repositories\CrazyRepositoryEloquent;
use English\Http\Repositories\CrazyWriteHistoryRepository;
use English\Http\Repositories\CrazyWriteHistoryRepositoryEloquent;
use English\Http\Repositories\FillInTheBlankRepository;
use English\Http\Repositories\FillInTheBlankRepositoryEloquent;
use English\Http\Repositories\MistakeRepository;
use English\Http\Repositories\MistakeRepositoryEloquent;
use English\Http\Repositories\PronunciationRepository;
use English\Http\Repositories\PronunciationRepositoryEloquent;
use English\Http\Repositories\SimilarityRepository;
use English\Http\Repositories\SimilarityRepositoryEloquent;
use English\Http\Repositories\VocabularyRepository;
use English\Http\Repositories\VocabularyRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class EnglishServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routers/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/../routers/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../routers/web.php');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CrazyDetailRepository::class, CrazyDetailRepositoryEloquent::class);
        $this->app->bind(CrazyRepository::class, CrazyRepositoryEloquent::class);
        $this->app->bind(CrazyHistoryRepository::class, CrazyHistoryRepositoryEloquent::class);
        $this->app->bind(CrazyWriteHistoryRepository::class, CrazyWriteHistoryRepositoryEloquent::class);
        $this->app->bind(CrazyCourseRepository::class, CrazyCourseRepositoryEloquent::class);
        $this->app->bind(FillInTheBlankRepository::class, FillInTheBlankRepositoryEloquent::class);
        $this->app->bind(PronunciationRepository::class, PronunciationRepositoryEloquent::class);
        $this->app->bind(MistakeRepository::class, MistakeRepositoryEloquent::class);
        $this->app->bind(SimilarityRepository::class, SimilarityRepositoryEloquent::class);
        $this->app->bind(VocabularyRepository::class, VocabularyRepositoryEloquent::class);
    }
}
