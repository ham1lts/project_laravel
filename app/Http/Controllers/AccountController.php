<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Interfaces\Bank\AccountRepositoryInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{
    /**
     * Get account by number
     */
    public function index(Request $request, AccountRepositoryInterface $accountRepository): Response
    {
        $account = $accountRepository->getByAccountNumber($request->get('numero_conta'));

        return response()->json(["numero_conta" => $account->getAccountNumber(), "saldo" => $account->getBalance()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountRequest $accountRequest, AccountRepositoryInterface $accountRepository): Response
    {
        $account = $accountRepository->create($accountRequest);

        return response()->json(
            ["numero_conta" => $account->getAccountNumber(), "saldo" => $account->getBalance()],
            Response::HTTP_CREATED
        );
    }
}
