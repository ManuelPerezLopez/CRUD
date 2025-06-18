<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use CodeIgniter\Controller;

class CatalogoController extends BaseController
{
    public function index()
    {
        $model = new ProductoModel();
        $productos = $model->findAll();

        return view('catalogo/index', ['productos' => $productos]);
    }
}
