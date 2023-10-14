<?php

namespace App\Providers;

use App\Events\BetEvent;
use App\Events\FightEvent;
use App\Listeners\BetListen;
use App\Listeners\FightListen;
use App\Listeners\QueryListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        BetEvent::class => [
            BetListen::class
        ],
        FightEvent::class => [
            FightListen::class
        ],
        'Illuminate\Database\Events\QueryExecuted' => [
            QueryListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Event::listen('Illuminate\Events\Dispatcher::firing', function ($event, $payload) {
            logger(json_encode($event), );
            logger(json_encode($payload), );
            // Xử lý sự kiện ở đây
            // $event là tên sự kiện, $payload là dữ liệu liên quan
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
