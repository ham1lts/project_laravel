<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Interfaces\AccountRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAccountExist
{
    public function handle(Request $request, Closure $next): Response
    {
        $accountRepository = app(AccountRepositoryInterface::class);
        if ($accountRepository->getByAccountNumber($request->numero_conta)) {
            return response()->json(['Existing Account'], Response::HTTP_BAD_REQUEST);
        }

        return $next($request);
    }
}
