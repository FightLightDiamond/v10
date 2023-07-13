<?php

namespace App\Providers;

use App\Repositories\AutoBetRepository;
use App\Repositories\AutoBetRepositoryEloquent;
use App\Repositories\BetRepository;
use App\Repositories\BetRepositoryEloquent;
use App\Repositories\EloMatchRepository;
use App\Repositories\EloMatchRepositoryEloquent;
use App\Repositories\GuildMatchRepository;
use App\Repositories\GuildMatchRepositoryEloquent;
use App\Repositories\HeroRepository;
use App\Repositories\HeroRepositoryEloquent;
use App\Repositories\RobMatchRepository;
use App\Repositories\RobMatchRepositoryEloquent;
use App\Repositories\TheMatchRepository;
use App\Repositories\TheMatchRepositoryEloquent;
use App\Repositories\TowerMatchRepository;
use App\Repositories\TowerMatchRepositoryEloquent;
use App\Repositories\TreeRepository;
use App\Repositories\TreeRepositoryEloquent;
use App\Repositories\UserGemRepository;
use App\Repositories\UserGemRepositoryEloquent;
use App\Repositories\UserHeroItemRepository;
use App\Repositories\UserHeroItemRepositoryEloquent;
use App\Repositories\UserHeroRepository;
use App\Repositories\UserHeroRepositoryEloquent;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(AutoBetRepository::class, AutoBetRepositoryEloquent::class);
        $this->app->singleton(BetRepository::class, BetRepositoryEloquent::class);
        $this->app->singleton(EloMatchRepository::class, EloMatchRepositoryEloquent::class);
        $this->app->singleton(GuildMatchRepository::class, GuildMatchRepositoryEloquent::class);
        $this->app->singleton(HeroRepository::class, HeroRepositoryEloquent::class);
        $this->app->singleton(RobMatchRepository::class, RobMatchRepositoryEloquent::class);
        $this->app->singleton(TheMatchRepository::class, TheMatchRepositoryEloquent::class);
        $this->app->singleton(TowerMatchRepository::class, TowerMatchRepositoryEloquent::class);
        $this->app->singleton(TreeRepository::class, TreeRepositoryEloquent::class);
        $this->app->singleton(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->singleton(UserGemRepository::class, UserGemRepositoryEloquent::class);
        $this->app->singleton(UserHeroRepository::class, UserHeroRepositoryEloquent::class);
        $this->app->singleton(UserHeroItemRepository::class, UserHeroItemRepositoryEloquent::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
