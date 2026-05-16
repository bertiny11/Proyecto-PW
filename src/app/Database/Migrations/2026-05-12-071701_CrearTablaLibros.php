<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearTablaLibros extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_libro' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'titulo' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'autor' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'isbn' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
            ],
            'estado' => [
                'type'       => 'VARCHAR',
                'constraint' => '50', // Ej: "Nuevo", "Dañado", "Desgastado"
            ],
            'disponibilidad' => [
                'type'       => 'VARCHAR',
                'constraint' => '50', // Ej: "Disponible", "Prestado", "Reservado"
            ],
            // NUEVA COLUMNA INYECTADA EN LA MIGRACIÓN
            'id_propietario' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id_libro', true);
        $this->forge->createTable('libros');
    }

    public function down()
    {
        $this->forge->dropTable('libros');
    }
}