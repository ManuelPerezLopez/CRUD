<?php
namespace App\Models;
use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'usuario_id', 'nombre', 'descripcion', 'precio',
        'unidad_medida', 'categoria', 'estatus', 'imagen'
    ];
    protected $useTimestamps = true;
}
