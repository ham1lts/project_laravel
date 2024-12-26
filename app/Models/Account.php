<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

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
