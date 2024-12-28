<?php
/**
 * Copyright © Freire H. All rights reserved.
 */

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TransacaoRequest;
use App\Services\TransacaoService;
use Symfony\Component\HttpFoundation\Response;

class TransacaoController extends Controller
{
    public function __construct(
        private readonly TransacaoService $transacaoService,
    ){}

    public function update(TransacaoRequest $transacaoRequest): Response
    {
        return $this->transacaoService->updateBalance($transacaoRequest);
    }
}
