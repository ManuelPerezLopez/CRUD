<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JWTAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeaderLine('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->setJSON(['error' => 'Token no proporcionado'])->setStatusCode(401);
        }

        $token = explode(' ', $authHeader)[1];

        try {
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            // Aquí puedes hacer validaciones extra si deseas (como usuario en DB)
        } catch (Exception $e) {
            return response()->setJSON(['error' => 'Token inválido o expirado'])->setStatusCode(401);
        }

        return null; // todo bien, dejar continuar
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se necesita código aquí
    }
}
