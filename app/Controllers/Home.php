<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class Home extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $usuariosModel = new \App\Models\UsuariosModel();

        $busqueda = $this->request->getGet('buscar');

        if ($busqueda) {
            $usuariosModel->like('nombre', $busqueda)
                ->orLike('email', $busqueda);
        }

        $data['usuarios'] = $usuariosModel->findAll(); // 🔄 sin paginación
        $data['buscar'] = $busqueda;

        return view('usuarios/index', $data);
    }




    /**
     * Return the propeties of a resource object
     * 
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {

        $usuariosModel = new UsuariosModel(); //retorna los registros de usuarios
        $data['usuarios'] = $usuariosModel->findAll(); //un arreglo llamado usuarios que busca todos los datos de la bd

        return view('usuarios/new', $data);  //regresa la vista new de la carpeta usuarios
    }


    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $reglas = [
            'nombre' => 'required|min_length[3]',
            'email' => [
                'rules' => 'required|valid_email|is_unique[usuarios.email]',
                'errors' => ['is_unique' => 'El correo electrónico ya está en uso.']
            ],
            'contraseña' => [
                'rules' => [
                    'required',
                    'min_length[8]',
                    'regex_match[/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/]'
                ],
                'errors' => [
                    'regex_match' => 'La contraseña debe tener al menos una mayúscula, un número y un carácter especial.'
                ]
            ],
            'confirmar' => 'required|matches[contraseña]'
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        $post = $this->request->getPost(['nombre', 'email', 'contraseña']);

        $usuariosModel = new UsuariosModel();

        $usuariosModel->insert([
            'nombre' => trim($post['nombre']),
            'email' => trim($post['email']),
            'contraseña' => password_hash(trim($post['contraseña']), PASSWORD_DEFAULT)
        ]);

        session()->setFlashdata('success', 'Usuario registrado correctamente.');
        return redirect()->to('usuarios');
    }





    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null) //recibe un id y sino lo recibe lo deja como nulo
    {
        if ($id == null) {  //validacion por si es nullo se regresa al index
            return redirect()->to('usuarios');
        }

        $usuariosModel = new UsuariosModel();
        $data['usuario'] = $usuariosModel->find($id);

        return view('usuarios/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $data = $this->request->getRawInput();  // obtiene los datos con el put simulado

        $validation = \Config\Services::validation(); //valida los datos con el metodo validation
        $validation->setRules([                       //valida las reglas con el metodo satRules
            'nombre' => 'required|min_length[3]',
            'email'  => "required|valid_email",
            'contraseña' => 'permit_empty|min_length[6]', //si ingresa una nueva contraseña
        ]);

        if ($validation->withRequest($this->request)->run()) { //catualiza los datos
            $usuariosModel = new UsuariosModel();  //crea un objeto del modelo usuariosModel
            $updateData = [
                'nombre' => $data['nombre'],
                'email'  => $data['email'],
            ];


            if (!empty($data['contraseña'])) { //si el input de contraseña NO esta vacio, entonces cambia la contraseña
                $updateData['contraseña'] = password_hash($data['contraseña'], PASSWORD_BCRYPT); //encripta antes de mandarla
            }

            $usuariosModel->update($id, $updateData);

            return redirect()->to('/usuarios');
        } else {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        if ($id === null) { // compara si el id es cvacio
            return redirect()->to('/usuarios'); //si es vacio te regresa al index
        }

        $usuariosModel = new UsuariosModel(); //se crea la instacia del modelo

        $usuario = $usuariosModel->find($id); // verifica si el usuario existe
        // Eliminar el usuario
        if ($usuariosModel->delete($id)) {
            return redirect()->to('/usuarios');
        } else {
            return redirect()->to('/usuarios');
        }
    }
}
