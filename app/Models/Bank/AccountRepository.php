<?php
declare(strict_types=1);

namespace App\Models\Bank;

use App\Interfaces\Bank\Data\AccountInterface;
use App\Models\Bank\Account;
use App\Interfaces\Bank\AccountRepositoryInterface;

class AccountRepository implements AccountRepositoryInterface
{
    public function getByAccountNumber($accountNumber): ?AccountInterface
    {
        return Account::whereAccountNumber($accountNumber)->first();
    }

    public function save($account): void
    {
        $account->save();
    }

    public function create($options): AccountInterface
    {
        $account = new Account();
        $account->setBalance($options->saldo);
        $account->setAccountNumber($options->numero_conta);
        $account->save();

        return $account;
    }
}
