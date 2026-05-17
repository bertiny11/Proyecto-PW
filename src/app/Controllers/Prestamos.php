<?php

namespace App\Controllers;

use App\Models\PrestamoModel;
use App\Models\LibroModel;

class Prestamos extends BaseController
{
    public function solicitar($idLibro)
    {
        // Solo los usuarios logeados pueden solicitar prestamos. 
        if (!usuario_logueado() || rol_actual() !== 'Usuario') {
            return redirect()->to('/login');
        }

        $libroModel = new LibroModel();
        $prestamoModel = new PrestamoModel();

        // Buscamos el libro que se quiere solicitar. 
        $libro = $libroModel->find($idLibro);

        if (!$libro) {
            return redirect()->to('/libros/listado')->with('error', 'El libro no existe.');
        }

        // Un usuario no puede solicitar un libro que él mismo ha subido.
        if ((int) $libro['id_propietario'] === (int) session()->get('id_usuario')) {
            return redirect()->to('/libros/listado')->with('error', 'No puedes solicitar un libro propio.');
        }

        // Comprobamos que el libro esta disponible antes de crear la solicitud. 
        if ($libro['disponibilidad'] !== 'Disponible' && $libro['disponibilidad'] != 1) {
            return redirect()->to('/libros/listado')->with('error', 'El libro no está disponible.');
        }

        // Evitamos crear má de una solicitud o prestamo para un mismo libro. 
        $prestamoExistente = $prestamoModel
            ->where('id_libro', $idLibro)
            ->whereIn('estado_prestamo', ['Solicitado', 'Activo'])
            ->first();

        if ($prestamoExistente) {
            return redirect()->to('/libros/listado')->with('error', 'Este libro ya tiene una solicitud o préstamo activo.');
        }

        // Creamos la solicitud de Prestamo. 
        $prestamoModel->insert([
            'id_libro'         => $idLibro,
            'id_prestatario'   => session()->get('id_usuario'),
            'estado_prestamo'  => 'Solicitado',
            'created_at'       => date('Y-m-d H:i:s'),
        ]);

        // Marcamos el libro como solicitado para que no pueda pedirse de nuevo. 
        $libroModel->update($idLibro, [
            'disponibilidad' => 'Solicitado',
        ]);

        return redirect()->to('/usuario/dashboard')->with('mensaje', 'Solicitud de préstamo enviada.');
    }

    public function aceptar($idPrestamo)
    {
        // Solo un usuario puede aceptar solicitudes de su propios libros. 
        if (!usuario_logueado() || rol_actual() !== 'Usuario') {
            return redirect()->to('/login');
        }

        $prestamoModel = new PrestamoModel();
        $libroModel = new LibroModel();

        // Buscamos el prestamo que se quiere aceptar. 
        $prestamo = $prestamoModel->find($idPrestamo);

        if (!$prestamo) {
            return redirect()->to('/usuario/dashboard')->with('error', 'El préstamo no existe.');
        }

        // Buscamos el libro asociado al prestamo. 
        $libro = $libroModel->find($prestamo['id_libro']);

        // Solo el propietario del libro puede aceptar la solicitud. 
        if (!$libro || (int) $libro['id_propietario'] !== (int) session()->get('id_usuario')) {
            return redirect()->to('/usuario/dashboard')->with('error', 'No tienes permiso para aceptar esta solicitud.');
        }

        // Cambiamos la solicitud a prestamo activo.
        $prestamoModel->update($idPrestamo, [
            'estado_prestamo' => 'Activo',
            'fecha_inicio'    => date('Y-m-d'),
            'fecha_fin'       => date('Y-m-d', strtotime('+15 days')),
        ]);

        // El libro pasa a estar "prestado". 
        $libroModel->update($prestamo['id_libro'], [
            'disponibilidad' => 'Prestado',
        ]);

        return redirect()->to('/usuario/dashboard')->with('mensaje', 'Solicitud aceptada.');
    }

    public function devolver($idPrestamo)
    {
        if (!usuario_logueado()) {
            return redirect()->to('/login');
        }

        $prestamoModel = new PrestamoModel();
        $libroModel = new LibroModel();

        // Buscamos el prestamo que se quiere marcar como devuelto. 
        $prestamo = $prestamoModel->find($idPrestamo);

        if (!$prestamo) {
            return redirect()->to('/')->with('error', 'El préstamo no existe.');
        }

        if (rol_actual() !== 'Administrador' && (int) $prestamo['id_prestatario'] !== (int) session()->get('id_usuario')) {
            return redirect()->to('/')->with('error', 'No tienes permiso para devolver este préstamo.');
        }

        // Eliminamos el prestamo. 
        $prestamoModel->update($idPrestamo, [
            'estado_prestamo' => 'Devuelto',
        ]);

        // El libro vuelve a estar "disponible". 
        $libroModel->update($prestamo['id_libro'], [
            'disponibilidad' => 'Disponible',
        ]);

        return redirect()->to(ruta_inicio_por_rol(rol_actual()))->with('mensaje', 'Libro marcado como devuelto.');
    }

    public function forzarDevolucion($idPrestamo)
    {
        // Solo el administrador puede forzar devoluciones. 
        if (!usuario_logueado() || rol_actual() !== 'Administrador') {
            return redirect()->to('/login');
        }

        $prestamoModel = new PrestamoModel();
        $libroModel = new LibroModel();

        // Buscamos el prestamo que el admin quiere cerrar manualmente. 
        $prestamo = $prestamoModel->find($idPrestamo);

        if (!$prestamo) {
            return redirect()->to('/admin/dashboard')->with('error', 'El préstamo no existe.');
        }

        // El admin elimina el prestamo. 
        $prestamoModel->update($idPrestamo, [
            'estado_prestamo' => 'Devuelto',
        ]);

        // El libro queda en estado "disponible". 
        $libroModel->update($prestamo['id_libro'], [
            'disponibilidad' => 'Disponible',
        ]);

        return redirect()->to('/admin/dashboard')->with('mensaje', 'Devolución forzada correctamente.');
    }
}