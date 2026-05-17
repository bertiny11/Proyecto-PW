<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearTablaPrestamos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_prestamo' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_libro' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'id_prestatario' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'fecha_inicio' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'fecha_fin' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'estado_prestamo' => [
                'type'       => 'ENUM',
                'constraint' => ['Solicitado', 'Activo', 'Devuelto', 'Disputa'],
                'default'    => 'Solicitado',
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_prestamo', true);

        $this->forge->addForeignKey('id_libro', 'libros', 'id_libro', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_prestatario', 'usuarios', 'ID_Usuario', 'CASCADE', 'CASCADE');

        $this->forge->createTable('prestamos');
    }

    public function down()
    {
        $this->forge->dropTable('prestamos');
    }
}