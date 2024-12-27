<?php
declare(strict_types=1);

namespace App\Interfaces\Bank\Data;

interface AccountInterface
{
    public function setAccountNumber($accountNumber);
    public function getAccountNumber();
    public function setBalance($balance);
    public function getBalance();
}
