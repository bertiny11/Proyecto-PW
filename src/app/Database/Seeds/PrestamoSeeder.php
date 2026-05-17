<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PrestamoSeeder extends Seeder
{
    public function run()
    {
        // Obtenemos todos los usuarios necesarios para asignar prestatarios.
        $usuarios = $this->db->table('usuarios')
            ->select('ID_Usuario, Nombre_Apellido, Rol')
            ->get()
            ->getResultArray();

        // Si no hay al menos 2 usuarios, no se pueden crear préstamos válidos.
        if (count($usuarios) < 2) {
            return;
        }

        // Obtenemos los libros disponibles en la base de datos.
        $libros = $this->db->table('libros')
            ->select('id_libro, titulo, id_propietario, disponibilidad')
            ->get()
            ->getResultArray();

        // Necesitamos al menos 2 libros para crear 2 préstamos de ejemplo.
        if (count($libros) < 2) {
            return;
        }

        // Aquí se guardarán temporalmente los préstamos antes de insertarlos.
        $prestamos = [];

        foreach ($libros as $libro) {

            // Evitamos usar libros que ya tengan un préstamo pendiente o activo.
            $prestamoExistente = $this->db->table('prestamos')
                ->where('id_libro', $libro['id_libro'])
                ->whereIn('estado_prestamo', ['Solicitado', 'Activo'])
                ->get()
                ->getRowArray();

            if ($prestamoExistente) {
                continue;
            }

            $prestatario = null;

            // Buscamos primero un usuario estándar que no sea propietario del libro.
            foreach ($usuarios as $usuario) {
                if (
                    (int) $usuario['ID_Usuario'] !== (int) $libro['id_propietario'] &&
                    $usuario['Rol'] === 'Usuario'
                ) {
                    $prestatario = $usuario;
                    break;
                }
            }

            // Si no existe usuario estándar válido, usamos cualquier usuario distinto al propietario.
            if (!$prestatario) {
                foreach ($usuarios as $usuario) {
                    if ((int) $usuario['ID_Usuario'] !== (int) $libro['id_propietario']) {
                        $prestatario = $usuario;
                        break;
                    }
                }
            }

            // Si no se ha encontrado prestatario válido, pasamos al siguiente libro.
            if (!$prestatario) {
                continue;
            }

            // Creamos un préstamo solicitado y otro activo.
            $estadoPrestamo = count($prestamos) === 0 ? 'Solicitado' : 'Activo';

            $prestamos[] = [
                'id_libro'         => $libro['id_libro'],
                'id_prestatario'   => $prestatario['ID_Usuario'],
                'fecha_inicio'     => $estadoPrestamo === 'Activo' ? date('Y-m-d') : null,
                'fecha_fin'        => $estadoPrestamo === 'Activo' ? date('Y-m-d', strtotime('+15 days')) : null,
                'estado_prestamo'  => $estadoPrestamo,
                'created_at'       => date('Y-m-d H:i:s'),
            ];

            // Actualizamos la disponibilidad del libro según el estado del préstamo.
            $this->db->table('libros')
                ->where('id_libro', $libro['id_libro'])
                ->update([
                    'disponibilidad' => $estadoPrestamo === 'Activo' ? 'Prestado' : 'Solicitado',
                ]);

            // Paramos cuando ya tenemos 2 préstamos preparados.
            if (count($prestamos) === 2) {
                break;
            }
        }

        // Si no se han conseguido preparar 2 préstamos, no insertamos nada.
        if (count($prestamos) < 2) {
            return;
        }

        // Insertamos los préstamos en la base de datos.
        $this->db->table('prestamos')->insertBatch($prestamos);
    }
}