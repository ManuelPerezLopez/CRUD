<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearTablaClientes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'nombre'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'correo'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'telefono'    => ['type' => 'VARCHAR', 'constraint' => 20],
            'estatus'     => ['type' => 'VARCHAR', 'constraint' => 20],
            'usuario_id'  => ['type' => 'INT', 'unsigned' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('usuario_id', 'usuarios', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('clientes');
    }

    public function down()
    {
        $this->forge->dropTable('clientes');
    }
}
