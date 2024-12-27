<?php

namespace Tests\Feature;

use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EndpointsContaTest extends TestCase
{
    use RefreshDatabase;

    const NUMERO_CONTA = "numero_conta";
    const ACCOUNT_NUMBER = "account_number";
    const SALDO = "saldo";
    const BALANCE = "balance";
    const RANDOM_FIELD = 'teste';

    public function test_success_create_account(): void
    {
        $response = $this->post('/api/conta', [
            self::NUMERO_CONTA => 85596,
            self::SALDO => 500
        ]);

        $response->assertStatus(201);
    }

    public function test_failed_account_creation_due_to_duplicate_account_number(): void
    {
        $data = [
            self::ACCOUNT_NUMBER => 5,
            self::BALANCE => 500
        ];

        Account::create($data);

        $response = $this->post('/api/conta', [
            self::NUMERO_CONTA => 5,
            self::SALDO => 200
        ]);

        $response->assertStatus(400);
    }

    public function test_failed_account_creation_due_to_invalid_data(): void
    {
        $response = $this->post('/api/conta', [
            self::NUMERO_CONTA => 'teste',
            self::SALDO => 500
        ]);

        $response->assertStatus(422);
    }

    public function test_account_creation_with_invalid_fields(): void
    {
        $response = $this->post('/api/conta', [
            self::RANDOM_FIELD => 5,
            self::SALDO => 500
        ]);

        $response->assertStatus(422);
    }

    public function test_success_get_account_information(): void
    {
        $data = [
            self::ACCOUNT_NUMBER => 85596,
            self::BALANCE => 500
        ];

        Account::create($data);

        $response = $this->get('/api/conta?numero_conta=85596');
        
        $response->assertContent('{"numero_conta":85596,"saldo":500}');
        $response->assertStatus(200);
    }

    public function test_failed_get_account_information(): void
    {
        $response = $this->get('/api/conta?numero_conta=85596');
        $response->assertStatus(404);
    }
}
