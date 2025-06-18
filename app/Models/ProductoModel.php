<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';

    // app/Models/ProductoModel.php
    protected $allowedFields = [
        'usuario_id',
        'nombre',
        'descripcion',
        'precio',
        'unidad_medida',
        'categoria',
        'estatus',
        'archivo'
    ];
    
}
