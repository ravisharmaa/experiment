<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use App\Listeners\NotifySystemAdmin;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\CriticalSystemIssueDetected' => [
            'App\Listeners\NotifySystemAdmin'
        ],
        'App\Events\NewUserAdded' => [
            'App\Listeners\ExecuteBashScript'
        ]
    ];


    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
