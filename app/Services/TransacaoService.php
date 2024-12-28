<?php
/**
 * Copyright © Freire H. All rights reserved.
 */

namespace App\Services;

use App\Interfaces\AccountRepositoryInterface;
use App\Interfaces\HistoryTransactionRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class TransacaoService
{
    const taxasTransacoes = [
        'D' => 0.03,
        'C' => 0.05,
        'P' => 0
    ];

    public function __construct(
        private readonly AccountRepositoryInterface $accountRepository,
        private readonly HistoryTransactionRepositoryInterface $historyTransactionRepository
    ){}

    public function updateBalance($transacaoRequest): Response
    {
        $account = $this->accountRepository->getByAccountNumber($transacaoRequest->numero_conta);
        $value = round($transacaoRequest->valor * (1 + self::taxasTransacoes[$transacaoRequest->forma_pagamento]), 2);

        if ($value <= $account->balance) {
            $account->balance = $account->balance - $value;
            $this->accountRepository->save($account);
            $this->saveHistoryTransaction($transacaoRequest, $value);

            return response()->json(
                ["numero_conta" => $account->account_number, "saldo" => $account->balance],
                Response::HTTP_CREATED
            );
        }

        return response()->json([], Response::HTTP_NOT_FOUND);
    }

    private function saveHistoryTransaction($transacaoRequest, $value)
    {
        $this->historyTransactionRepository->create(
            [
                'account_number' => $transacaoRequest->numero_conta,
                'operation' => $transacaoRequest->forma_pagamento,
                'value' => $value,
            ]
        );
    }
}
