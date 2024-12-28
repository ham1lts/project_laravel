<?php
/**
 * Copyright © Freire H. All rights reserved.
 */

declare(strict_types=1);

namespace App\Interfaces;

interface HistoryTransactionRepositoryInterface
{
    public function create($data);
}
