<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UsuarioModel;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        $usuarioModel = new UsuarioModel();

        $usuarios = [
            [
                'Nombre_Apellido' => 'Administrador Jefe',
                'Email'           => 'admin@biblioteca.com',
                'Contrasena'      => password_hash('123456', PASSWORD_DEFAULT),
                'Rol'             => 'Administrador',
                'Ubicacion'       => 'Sede Central'
            ],
            [
                'Nombre_Apellido' => 'Alberto Lector',
                'Email'           => 'alberto@correo.com',
                'Contrasena'      => password_hash('123456', PASSWORD_DEFAULT),
                'Rol'             => 'Usuario',
                'Ubicacion'       => 'Cádiz'
            ],
            // NUEVO USUARIO AÑADIDO (Tomará automáticamente el ID: 3)
            [
                'Nombre_Apellido' => 'Carlos Gómez',
                'Email'           => 'carlos@correo.com',
                'Contrasena'      => password_hash('123456', PASSWORD_DEFAULT),
                'Rol'             => 'Usuario',
                'Ubicacion'       => 'Jerez'
            ]
        ];

        // Insertamos los usuarios en la base de datos
        foreach ($usuarios as $usuario) {
            $usuarioModel->insert($usuario);
        }
    }
}