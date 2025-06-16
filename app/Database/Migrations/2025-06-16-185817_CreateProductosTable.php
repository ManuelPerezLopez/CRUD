<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'usuario_id' => ['type' => 'INT', 'unsigned' => true],
            'nombre' => ['type' => 'VARCHAR', 'constraint' => 255],
            'descripcion' => ['type' => 'TEXT'],
            'precio' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'unidad_medida' => ['type' => 'VARCHAR', 'constraint' => 50],
            'categoria' => ['type' => 'VARCHAR', 'constraint' => 100],
            'estatus' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'activo'],
            'archivo' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('usuario_id', 'usuarios', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('productos');
    }

    public function down()
    {
        $this->forge->dropTable('productos');
    }
}
