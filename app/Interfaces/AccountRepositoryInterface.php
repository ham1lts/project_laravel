<?php
/**
 * Copyright © Freire H. All rights reserved.
 */

declare(strict_types=1);

namespace App\Interfaces;

interface AccountRepositoryInterface
{
    public function getByAccountNumber($accountNumber);

    public function create($data);

    public function save($account);
}
