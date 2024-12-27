<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TransacaoRequest;
use App\Interfaces\Bank\AccountRepositoryInterface;
use App\Interfaces\Bank\Data\AccountInterface;
use App\Models\Bank\Account;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransacaoController extends Controller
{
    const taxasTransacoes = [
        'D' => 0.03,
        'C' => 0.05,
        'P' => 0
    ];

    public function update(TransacaoRequest $transacaoRequest, AccountRepositoryInterface $accountRepository): Response
    {
        $account = $accountRepository->getByAccountNumber($transacaoRequest->numero_conta);
        $value = $transacaoRequest->valor * (1 + self::taxasTransacoes[$transacaoRequest->forma_pagamento]);

        if ($value <= $account->getBalance()) {
            $account->setBalance($account->getBalance() - $value);
            $account->save();

            return response()->json(
                ["numero_conta" => $account->getAccountNumber(), "saldo" => $account->getBalance()],
                Response::HTTP_CREATED
            );
        }

        return response()->json([], Response::HTTP_NOT_FOUND);
    }
}
