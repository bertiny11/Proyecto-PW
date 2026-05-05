<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CrearTablaUsuarios extends Migration
{
    public function up()
    {
        // Definimos las columnas exactamente como en el diagrama E-R
        $this->forge->addField([
            'ID_Usuario' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true, // Buena práctica para IDs
                'auto_increment' => true, // AI en el diagrama
            ],
            'Nombre_Apellido' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true, // No tiene * en el diagrama
            ],
            'Email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique'     => true, // Unique en el diagrama
                'null'       => false, // Tiene * en el diagrama
            ],
            'Contrasena' => [ // Cambiamos 'ñ' por 'n' para evitar errores en MySQL
                'type'       => 'VARCHAR',
                'constraint' => '255', // Largo para poder encriptarla
                'null'       => true,
            ],
            'Rol' => [
                'type'       => 'ENUM',
                'constraint' => ['Administrador', 'Usuario'], // Los roles exactos de tu diagrama
                'default'    => 'Usuario',
                'null'       => false, // Tiene * en el diagrama
            ],
            'Ubicacion' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true, // No tiene * en el diagrama
            ],
        ]);
        
        // PK (Primary Key) en el diagrama
        $this->forge->addKey('ID_Usuario', true);
        
        // Creamos la tabla
        $this->forge->createTable('usuarios');
    }

    public function down()
    {
        $this->forge->dropTable('usuarios');
    }
}