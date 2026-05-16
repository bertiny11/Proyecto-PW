<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LibroSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // --- LIBROS ORIGINALES ---
            [
                'titulo'         => 'Desarrollo Backend con PHP',
                'autor'          => 'Alberto Heredia',
                'isbn'           => '978-1234567890',
                'estado'         => 'Nuevo',
                'disponibilidad' => 'Disponible',
                'id_propietario' => 2, // Pertenece a Alberto Lector (ID: 2)
                'created_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'titulo'         => 'Redes Cisco CCNA',
                'autor'          => 'Andrew Tanenbaum',
                'isbn'           => '978-0987654321',
                'estado'         => 'Usado',
                'disponibilidad' => 'Prestado',
                'id_propietario' => 1, // Pertenece al Admin (ID: 1)
                'created_at'     => date('Y-m-d H:i:s'),
            ],

            // --- 2 LIBROS NUEVOS PARA ALBERTO LECTOR (ID: 2) ---
            [
                'titulo'         => 'Patrones de Diseño',
                'autor'          => 'Erich Gamma',
                'isbn'           => '978-0201633610',
                'estado'         => 'Buen estado',
                'disponibilidad' => 'Disponible',
                'id_propietario' => 2, 
                'created_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'titulo'         => 'Código Limpio',
                'autor'          => 'Robert C. Martin',
                'isbn'           => '978-8441526945',
                'estado'         => 'Nuevo',
                'disponibilidad' => 'Disponible',
                'id_propietario' => 2, 
                'created_at'     => date('Y-m-d H:i:s'),
            ],

            // --- 3 LIBROS NUEVOS PARA CARLOS GÓMEZ (ID: 3) ---
            [
                'titulo'         => 'El Quijote',
                'autor'          => 'Miguel de Cervantes',
                'isbn'           => '978-8420412146',
                'estado'         => 'Usado',
                'disponibilidad' => 'Disponible',
                'id_propietario' => 3, 
                'created_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'titulo'         => 'Física Cuántica',
                'autor'          => 'Richard Feynman',
                'isbn'           => '978-8437604947',
                'estado'         => 'Buen estado',
                'disponibilidad' => 'Prestado',
                'id_propietario' => 3, 
                'created_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'titulo'         => 'El Principito',
                'autor'          => 'Antoine de Saint-Exupéry',
                'isbn'           => '978-8441526754',
                'estado'         => 'Nuevo',
                'disponibilidad' => 'Disponible',
                'id_propietario' => 3, 
                'created_at'     => date('Y-m-d H:i:s'),
            ]
        ];
        
        // Insertar todos los libros de golpe en la tabla
        $this->db->table('libros')->insertBatch($data);
    }
}