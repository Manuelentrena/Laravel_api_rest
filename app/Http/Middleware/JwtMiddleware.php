<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Symfony\Component\HttpFoundation\Response as StatusCode;


class JwtMiddleware extends BaseMiddleware
{

    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'token_expired'], StatusCode::HTTP_UNAUTHORIZED);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'token_invalid'], StatusCode::HTTP_UNAUTHORIZED);
        } catch (JWTException $e) {
            return response()->json(['error' => 'token_absent'], StatusCode::HTTP_UNAUTHORIZED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], StatusCode::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $next($request);
    }
}
