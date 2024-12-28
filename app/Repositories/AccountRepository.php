<?php
/**
 * Copyright © Freire H. All rights reserved.
 */

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\AccountRepositoryInterface;
use App\Models\Account;

class AccountRepository implements AccountRepositoryInterface
{
    public function getByAccountNumber($accountNumber): ?Account
    {
        return Account::whereAccountNumber($accountNumber)->first();
    }

    public function save($account): void
    {
        $account->save();
    }

    public function create($data): Account
    {
        return Account::create($data);
    }
}
