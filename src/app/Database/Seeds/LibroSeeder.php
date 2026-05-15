<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LibroSeeder extends Seeder
{
    public function run()
    {
        $data = [
    [
        'titulo'         => 'Desarrollo Backend con PHP',
        'autor'          => 'Alberto Heredia',
        'isbn'           => '978-1234567890',
        'estado'         => 'Nuevo',
        'disponibilidad' => 'Disponible',
        'created_at'     => date('Y-m-d H:i:s'),
    ],
    [
        'titulo'         => 'Redes Cisco CCNA',
        'autor'          => 'Andrew Tanenbaum',
        'isbn'           => '978-0987654321',
        'estado'         => 'Usado',
        'disponibilidad' => 'Prestado',
        'created_at'     => date('Y-m-d H:i:s'),
    ]
];
        // Insertar todos los libros de golpe en la tabla
        $this->db->table('libros')->insertBatch($data);
    }
}