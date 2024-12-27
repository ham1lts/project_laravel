<?php
declare(strict_types=1);

namespace App\Models\Bank;

use App\Interfaces\Bank\Data\AccountInterface;
use Illuminate\Database\Eloquent\Model;

class Account extends Model implements AccountInterface
{
    public function setAccountNumber($accountNumber): void
    {
        $this->account_number = $accountNumber;
    }

    public function getAccountNumber(): int
    {
        return $this->account_number;
    }

    public function setBalance($balance): void
    {
        $this->balance = $balance;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }
}
