<?php
/**
 * Copyright © Freire H. All rights reserved.
 */

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\HistoryTransactionRepositoryInterface;
use App\Models\Account;
use App\Models\HistoryTransaction;

class HistoryTransactionRepository implements HistoryTransactionRepositoryInterface
{
    public function create($data): HistoryTransaction
    {
        return HistoryTransaction::create($data);
    }
}
