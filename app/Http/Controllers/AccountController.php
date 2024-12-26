<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $account = Account::whereAccountNumber($request->get('numero_conta'))->first();
        if (empty($account)) {
            return response()->json('Número de Conta inexistente');
        }

        return response()->json(["numero_conta" => $account->getAccountNumber(), "saldo" => $account->getBalance()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $account = new Account();
        $account->setBalance($request->saldo);
        $account->setAccountNumber($request->numero_conta);
        $account->save();

        return response()->json(['success' => true, 'data' => $account], Response::HTTP_CREATED);
    }
}
