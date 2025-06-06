<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function loginForm()
    {
        return view('auth/login'); // debe coincidir con la ruta de tu vista
    }

    public function index()
    {
        //
    }
    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $usuario = model('UsuariosModel')->where('email', $email)->first();

        if (!$usuario || !password_verify($password, $usuario['contraseña'])) {
            return $this->response->setStatusCode(401)->setJSON(['message' => 'Credenciales inválidas']);
        }

        $key = getenv('JWT_SECRET');
        $payload = [
            'iss' => 'http://localhost',
            'aud' => 'http://localhost',
            'iat' => time(),
            'exp' => time() + 3600,
            'sub' => $usuario['id']
        ];

        $jwt = JWT::encode($payload, $key, 'HS256');

        return $this->response->setJSON(['token' => $jwt]);
    }
}
