<?php

namespace App\Controllers;

use App\Models\ClienteModel;

class Clientes extends BaseController
{
    public function index($usuarioId)
    {
        $clienteModel = new ClienteModel();
        $busqueda = $this->request->getGet('buscar');

        $query = $clienteModel->where('usuario_id', $usuarioId);

        if ($busqueda) {
            $query->groupStart()
                  ->like('nombre', $busqueda)
                  ->orLike('correo', $busqueda)
                  ->orLike('estatus', $busqueda)
                  ->groupEnd();
        }

        $data['clientes'] = $query->findAll();
        $data['usuarioId'] = $usuarioId;
        $data['buscar'] = $busqueda;

        return view('clientes/index', $data);
    }

    public function new($usuarioId)
    {
        $data['usuarioId'] = $usuarioId;
        return view('clientes/new', $data);
    }

    public function create($usuarioId)
    {
        $rules = [
            'nombre' => 'required',
            'correo' => 'required|valid_email',
            'telefono' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $clienteModel = new ClienteModel();
        $clienteModel->insert([
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $this->request->getPost('correo'),
            'telefono' => $this->request->getPost('telefono'),
            'estatus' => $this->request->getPost('estatus') ?? 'activo',
            'usuario_id' => $usuarioId
        ]);

        return redirect()->to("/clientes/index/$usuarioId");
    }

    public function edit($id)
    {
        $clienteModel = new ClienteModel();
        $data['cliente'] = $clienteModel->find($id);
        return view('clientes/edit', $data);
    }

    public function update($id)
    {
        $clienteModel = new ClienteModel();
        $cliente = $clienteModel->find($id);

        $rules = [
            'nombre' => 'required',
            'correo' => 'required|valid_email',
            'telefono' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $clienteModel->update($id, [
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $this->request->getPost('correo'),
            'telefono' => $this->request->getPost('telefono'),
            'estatus' => $this->request->getPost('estatus'),
        ]);

        return redirect()->to("/clientes/index/" . $cliente['usuario_id']);
    }

    public function delete($id)
    {
        $clienteModel = new ClienteModel();
        $cliente = $clienteModel->find($id);

        if ($cliente) {
            $clienteModel->delete($id);
            return redirect()->to("/clientes/index/" . $cliente['usuario_id']);
        }

        return redirect()->back();
    }
}
