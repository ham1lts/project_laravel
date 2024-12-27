<?php
/**
 * Copyright © Freire H. All rights reserved.
 */

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{
    public function __construct(
        private readonly AccountService $accountService,
    ){}

    /**
     * Get account by number
     */
    public function index(Request $request): Response
    {
        $account = $this->accountService->getAccount($request->get('numero_conta'));

        return response()->json(["numero_conta" => $account->account_number, "saldo" => $account->balance]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountRequest $accountRequest): Response
    {
        $account = $this->accountService->createAccount($accountRequest);

        return response()->json(
            ["numero_conta" => $account->account_number, "saldo" => $account->balance],
            Response::HTTP_CREATED
        );
    }
}
