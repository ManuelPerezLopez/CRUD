<?php
namespace App\Models;
use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'usuario_id',
        'nombre',
        'descripcion',
        'precio',
        'unidad_medida',       // ✅ corregido
        'categoria',
        'estatus',
        'archivo'       // ✅ corregido
    ];
    protected $useTimestamps = true;
}
