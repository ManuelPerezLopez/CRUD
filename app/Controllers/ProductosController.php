<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductoModel;
use App\Models\UsuariosModel;

class ProductosController extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function index($usuarioId)
    {
        $model = new ProductoModel();

        // Obtener texto del buscador
        $buscar = $this->request->getGet('buscarProducto');

        if ($buscar) {
            $productos = $model->where('usuario_id', $usuarioId)
                ->groupStart()
                ->like('nombre', $buscar)
                ->orLike('categoria', $buscar)
                ->orLike('estatus', $buscar)
                ->groupEnd()
                ->findAll();
        } else {
            $productos = $model->where('usuario_id', $usuarioId)->findAll();
        }

        return view('productos/index', [
            'productos' => $productos,
            'usuarioId' => $usuarioId,
            'buscarProducto' => $buscar
        ]);
    }


    public function new($usuarioId)
    {
        return view('productos/new', ['usuarioId' => $usuarioId]);
    }

    public function store($usuarioId)
    {
        $validation = \Config\Services::validation();

        $rules = [
            'nombre'         => 'required|min_length[3]',
            'descripcion'    => 'required',
            'precio'         => 'required|decimal',
            'unidad_medida'  => 'required',
            'categoria'      => 'required',
            'estatus'        => 'required|in_list[activo,inactivo]',
            'archivo'        => 'uploaded[archivo]|max_size[archivo,2048]|ext_in[archivo,jpg,jpeg,png,pdf,docx]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Verificar que el usuario exista
        $usuarioModel = new UsuariosModel();
        $usuario = $usuarioModel->find($usuarioId);


        if (!$usuario) {
            return redirect()->back()->with('error', 'El usuario no existe');
        }

        $archivo = $this->request->getFile('archivo');
        $nombreArchivo = $archivo->getRandomName();
        $archivo->move(ROOTPATH . 'public/uploads', $nombreArchivo);

        $model = new ProductoModel();
        $model->save([
            'usuario_id'     => $usuarioId,
            'nombre'         => $this->request->getPost('nombre'),
            'descripcion'    => $this->request->getPost('descripcion'),
            'precio'         => $this->request->getPost('precio'),
            'unidad_medida'  => $this->request->getPost('unidad_medida'),
            'categoria'      => $this->request->getPost('categoria'),
            'estatus'        => $this->request->getPost('estatus'),
            'archivo'        => $nombreArchivo
        ]);

        return redirect()->to("/productos/$usuarioId")->with('success', 'Producto registrado correctamente');
    }

    public function edit($id)
    {
        $model = new ProductoModel();
        $producto = $model->find($id);

        if (!$producto) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Producto no encontrado.");
        }

        return view('productos/edit', ['producto' => $producto]);
    }

    public function update($id)
    {
        $model = new ProductoModel();
        $producto = $model->find($id);

        if (!$producto) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Producto no encontrado.");
        }

        $archivo = $this->request->getFile('archivo');
        $nombreArchivo = $producto['archivo'];

        if ($archivo && $archivo->isValid()) {
            $nombreArchivo = $archivo->getRandomName();
            $archivo->move(ROOTPATH . 'public/uploads', $nombreArchivo);
        }

        $model->update($id, [
            'nombre'         => $this->request->getPost('nombre'),
            'descripcion'    => $this->request->getPost('descripcion'),
            'precio'         => $this->request->getPost('precio'),
            'unidad_medida'  => $this->request->getPost('unidad_medida'),
            'categoria'      => $this->request->getPost('categoria'),
            'estatus'        => $this->request->getPost('estatus'),
            'archivo'        => $nombreArchivo
        ]);

        return redirect()->to("/productos/" . $producto['usuario_id']);
    }

    public function delete($id)
    {
        $model = new ProductoModel();
        $producto = $model->find($id);

        if ($producto) {
            $model->delete($id);
        }

        return redirect()->to("/productos/" . $producto['usuario_id']);
    }
}
