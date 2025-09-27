<?php

namespace App\Providers;

use App\Models\CallTicket;
use App\Observers\CallTicketObserver;
use App\Repositories\ObjetRepository;
use App\Repositories\ObjetRepositoryInterface;
use App\Repositories\SpecialiteRepository;
use App\Repositories\SpecialiteRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(SpecialiteRepositoryInterface::class, SpecialiteRepository::class);
        $this->app->bind(
            \App\Repositories\CallTicketRepositoryInterface::class,
            \App\Repositories\CallTicketRepository::class
        );
        $this->app->bind(ObjetRepositoryInterface::class, ObjetRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        CallTicket::observe(CallTicketObserver::class);
    }
}
