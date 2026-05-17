<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AnadirEstadoUsuario extends Migration
{
    public function up()
    {
        $this->forge->addColumn('usuarios', [
            'Estado_Usuario' => [
                'type'       => 'ENUM',
                'constraint' => ['Activo', 'Baneado'],
                'default'    => 'Activo',
                'null'       => false,
                'after'      => 'Rol',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('usuarios', 'Estado_Usuario');
    }
}