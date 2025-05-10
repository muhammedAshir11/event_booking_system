<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\EventRepositoryInterface;
use App\Repositories\EventRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
