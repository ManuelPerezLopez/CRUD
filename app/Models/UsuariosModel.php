<?php

namespace App\Models;
use CodeIgniter\Model;  //clase padre

class UsuariosModel extends Model{ //copie la base del modelo de la documentacion de codeigniter

    protected $table      = 'usuarios'; //nombre de la tabla
    protected $primaryKey = 'id'; //id de la tabla

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; //object puede ser una u otra
    protected $useSoftDeletes = false; //en false para que elimine los usuarios

    protected $allowedFields = ['nombre', 'email', 'contraseña']; //se ponen los campos de la tabla menos las fechas

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_crea';    //para que se asignen fechas automaticas al insertar, modificar y borrar
    protected $updatedField  = 'fecha_actu';
    protected $deletedField  = 'fecha_elim';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

}