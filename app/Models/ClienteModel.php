<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nombre', 'correo', 'telefono', 'estatus', 'usuario_id'];
    protected $useTimestamps = true; // activa created_at y updated_at
}
