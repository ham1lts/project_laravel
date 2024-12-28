<?php

namespace App\Providers;

use App\Interfaces\AccountRepositoryInterface;
use App\Interfaces\HistoryTransactionRepositoryInterface;
use App\Models\Account;
use App\Repositories\AccountRepository;
use App\Repositories\HistoryTransactionRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AccountRepositoryInterface::class, AccountRepository::class);
        $this->app->singleton(HistoryTransactionRepositoryInterface::class, HistoryTransactionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
