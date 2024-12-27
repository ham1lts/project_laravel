<?php
declare(strict_types=1);

namespace App\Interfaces\Bank;

interface AccountRepositoryInterface
{
    public function getByAccountNumber($accountNumber);

    public function create($options);

    public function save($account);
}
