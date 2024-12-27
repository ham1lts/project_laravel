<?php

namespace App\Providers;

use App\Interfaces\AccountRepositoryInterface;
use App\Models\Account;
use App\Repositories\AccountRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AccountRepositoryInterface::class, AccountRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
