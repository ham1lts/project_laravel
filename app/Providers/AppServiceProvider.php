<?php

namespace App\Providers;

use App\Interfaces\Bank\AccountRepositoryInterface;
use App\Interfaces\Bank\Data\AccountInterface;
use App\Models\Bank\Account;
use App\Models\Bank\AccountRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AccountRepositoryInterface::class, AccountRepository::class);
        $this->app->singleton(AccountInterface::class, Account::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
