<?php
//se creo con el comando php spark make:migration CreaTablaUsuarios y se ejecuto con el comando php spark migrate en la terminal
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreaTablaUsuarios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned'       => true, // <-- Esto es importante
                'constraint' => 11,
                'auto_increment' => true
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'contraseña' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'fecha_crea' => [
                'type' => 'DATETIME'
            ],
            'fecha_actu' => [
                'type' => 'DATETIME'
            ],
            'fecha_elim' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        //clave primaria
        $this->forge->addKey('id', true);

        //crea la tabla usuarios
        $this->forge->createTable('usuarios');
    }

    public function down()
    {
        //elimina la tabla
        $this->forge->dropTable('usuarios');
    }
}