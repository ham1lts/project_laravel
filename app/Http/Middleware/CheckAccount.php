<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Interfaces\Bank\AccountRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAccount
{
    public function handle(Request $request, Closure $next): Response
    {
        $accountRepository = app(AccountRepositoryInterface::class);
        if ($accountRepository->getByAccountNumber($request->numero_conta)) {
            return $next($request);
        }

        return response()->json(['Número de Conta inexistente'], Response::HTTP_NOT_FOUND);
    }
}
