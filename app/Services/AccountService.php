<?php
/**
 * Copyright © Freire H. All rights reserved.
 */

namespace App\Services;

use App\Interfaces\AccountRepositoryInterface;
use App\Models\Account;

class AccountService
{
    public function __construct(
        private readonly AccountRepositoryInterface $accountRepository
    ){}

    public function getAccount($accountNumber): Account
    {
        return $this->accountRepository->getByAccountNumber($accountNumber);
    }

    public function createAccount($accountRequest)
    {
        $data = [
            'account_number' => $accountRequest->numero_conta,
            'balance' => $accountRequest->saldo
        ];

        return $this->accountRepository->create($data);
    }
}
