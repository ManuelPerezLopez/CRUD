<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class JWT extends BaseConfig
{
    public $secretKey = 'clave_secreta_super_segura'; // cámbiala por seguridad
    public $expirationTime = 3600; // 1 hora
}
