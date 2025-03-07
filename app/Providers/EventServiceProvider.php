<?php

namespace App\Providers;

use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Models\Washer;
use App\Models\WashTransaction;
use App\Observers\VehicleObserver;
use App\Observers\VehicleTypeObserver;
use App\Observers\WasherObserver;
use App\Observers\WashTransactionObserver;
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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        VehicleType::observe(VehicleTypeObserver::class);
        Vehicle::observe(VehicleObserver::class);
        Washer::observe(WasherObserver::class);
        WashTransaction::observe(WashTransactionObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
