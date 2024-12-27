<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Interfaces\AccountRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAccount
{
    public function __construct(
        private readonly AccountRepositoryInterface $accountRepository,
    ){}

    public function handle(Request $request, Closure $next): Response
    {
        if ($this->accountRepository->getByAccountNumber($request->numero_conta)) {
            return $next($request);
        }

        return response()->json(['Número de Conta inexistente'], Response::HTTP_NOT_FOUND);
    }
}
