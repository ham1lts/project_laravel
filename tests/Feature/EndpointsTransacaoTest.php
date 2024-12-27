<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Services\TransacaoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EndpointsTransacaoTest extends TestCase
{
    use RefreshDatabase;

    const NUMERO_CONTA = "numero_conta";
    const ACCOUNT_NUMBER = "account_number";
    const SALDO = "saldo";
    const BALANCE = "balance";
    const VALOR = "valor";
    const FORMA_PAGAMENTO = "forma_pagamento";
    const RANDOM_FIELD = "teste";

    public function test_success_transaction_debit_card(): void
    {
        $accountNumber = rand(1,5000);
        $balance = rand(1,100000) / 100;
        $value = $balance * (0.70);

        $data = [
            self::ACCOUNT_NUMBER => $accountNumber,
            self::BALANCE => $balance
        ];

        Account::create($data);

        $response = $this->post('/api/transacao', [
            self::FORMA_PAGAMENTO => "D",
            self::NUMERO_CONTA => $accountNumber,
            self::VALOR => $value
        ]);

        $response->assertStatus(201);
    }

    public function test_success_transaction_credit_card(): void
    {
        $accountNumber = rand(1,5000);
        $balance = rand(1,100000) / 100;
        $value = $balance * (0.70);

        $data = [
            self::ACCOUNT_NUMBER => $accountNumber,
            self::BALANCE => $balance
        ];

        Account::create($data);

        $response = $this->post('/api/transacao', [
            self::FORMA_PAGAMENTO => "C",
            self::NUMERO_CONTA => $accountNumber,
            self::VALOR => $value
        ]);

        $response->assertStatus(201);
    }

    public function test_success_transaction_pix(): void
    {
        $accountNumber = rand(1,5000);
        $balance = rand(1,100000) / 100;
        $value = $balance;

        $data = [
            self::ACCOUNT_NUMBER => $accountNumber,
            self::BALANCE => $balance
        ];

        Account::create($data);

        $response = $this->post('/api/transacao', [
            self::FORMA_PAGAMENTO => "P",
            self::NUMERO_CONTA => $accountNumber,
            self::VALOR => $value
        ]);

        $response->assertStatus(201);
    }

    public function test_failed_transaction_due_invalid_fields(): void
    {
        $accountNumber = rand(1,5000);
        $balance = rand(1,100000) / 100;
        $value = $balance * (0.70);

        $data = [
            self::ACCOUNT_NUMBER => $accountNumber,
            self::BALANCE => $balance
        ];

        Account::create($data);

        $responseValor = $this->post('/api/transacao', [
            self::FORMA_PAGAMENTO => "D",
            self::NUMERO_CONTA => $accountNumber,
            self::RANDOM_FIELD => $value
        ])->status();

        $responseFormaPagamento = $this->post('/api/transacao', [
            self::FORMA_PAGAMENTO => "S",
            self::NUMERO_CONTA => $accountNumber,
            self::VALOR => $value
        ])->status();

        $responseNumeroConta = $this->post('/api/transacao', [
            self::FORMA_PAGAMENTO => "P",
            self::NUMERO_CONTA => $accountNumber,
            self::VALOR => -15
        ])->status();

        $this->assertEquals([422, 422, 422], [$responseValor, $responseFormaPagamento, $responseNumeroConta]);
    }

    public function test_failed_transaction_due_to_insufficient_balance(): void
    {
        $accountNumber = rand(1,5000);
        $balance = rand(1,100000) / 100;
        $value = $balance * (1.01);

        $data = [
            self::ACCOUNT_NUMBER => $accountNumber,
            self::BALANCE => $balance
        ];

        Account::create($data);

        foreach (TransacaoService::taxasTransacoes as $transacao => $rate){
            $response = $this->post('/api/transacao', [
                self::FORMA_PAGAMENTO => $transacao,
                self::NUMERO_CONTA => $accountNumber,
                self::VALOR => $value
            ]);

            $response->assertStatus(404);
        }
    }
}
