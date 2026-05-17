<?php

namespace App\Controllers;

use App\Models\LibroModel;
use App\Models\UsuarioModel;
use App\Models\PrestamoModel;

class Home extends BaseController
{
    public function index()
    {
        // 1. Verificación de seguridad de Bertini
        if (!usuario_logueado()) {
            return redirect()->to('/login');
        }

        // 2. Detectamos qué vista de dashboard corresponde por rol
        $vista = vista_dashboard_por_rol(rol_actual());
        
        // Creamos los modelos para poder consultar la base de datos.
        $libroModel = new LibroModel();         // Model de Dani 
        $usuarioModel = new UsuarioModel();
        $prestamoModel = new PrestamoModel();

        $data = [];

        // 3. Si el rol es Usuario, cargamos dinámicamente sus libros de la BD
        if (rol_actual() === 'Usuario') {
            // Obtenemos el id del usuario que ha iniciado sesión.
            // Este id se usa para mostrar solo sus propios datos(tantos libros como prestamos)
            $idUsuario = session()->get('id_usuario');
            
            // Filtramos solo los libros que le pertenecen al usuario logueado
            $data['libros_propios'] = $libroModel->where('id_propietario', $idUsuario)->findAll();

            // Filtramos solo los prestamos que le pertenecen al usuario logeado. 
            $data['mis_prestamos'] = $prestamoModel
                ->select('prestamos.*, libros.titulo, libros.autor')
                ->join('libros', 'libros.id_libro = prestamos.id_libro')
                ->where('prestamos.id_prestatario', $idUsuario)
                ->whereIn('prestamos.estado_prestamo', ['Solicitado', 'Activo'])
                ->findAll();

            // Filtramos solicitudes de prestamos hechas sobre libros que pertenecen al usuario logeado.
            $data['solicitudes_recibidas'] = $prestamoModel
                ->select('prestamos.*, libros.titulo, libros.autor, usuarios.Nombre_Apellido AS nombre_prestatario')
                ->join('libros', 'libros.id_libro = prestamos.id_libro')
                ->join('usuarios', 'usuarios.ID_Usuario = prestamos.id_prestatario')
                ->where('libros.id_propietario', $idUsuario)
                ->where('prestamos.estado_prestamo', 'Solicitado')
                ->findAll();
        }

        // 4. Si el rol es administrador, cargamos los datos realcionados a él
        if (rol_actual() === 'Administrador') {

            // Cargamos todos los usuarios que se encuentran en la base de datos. 
            $data['usuarios'] = $usuarioModel->findAll();
            
            // Cargamos todos los prestamos que requieren control.
            $data['prestamos'] = $prestamoModel
                ->select('prestamos.*, libros.titulo, usuarios.Nombre_Apellido AS nombre_prestatario')
                ->join('libros', 'libros.id_libro = prestamos.id_libro')
                ->join('usuarios', 'usuarios.ID_Usuario = prestamos.id_prestatario')
                ->whereIn('prestamos.estado_prestamo', ['Solicitado', 'Activo', 'Disputa'])
                ->findAll();

        }

        // 5. Pasamos el array $data con los libros reales a la vista
        return view($vista, $data);
    }
}