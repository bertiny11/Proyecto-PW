<?php

namespace App\Controllers;

use App\Models\LibroModel;

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
        
        $data = [];

        // 3. Si el rol es Usuario, cargamos dinámicamente sus libros de la BD
        if (rol_actual() === 'Usuario') {
            $model = new LibroModel();
            
            // Filtramos solo los libros que le pertenecen al usuario logueado
            $data['libros_propios'] = $model->where('id_propietario', session()->get('id_usuario'))->findAll();
        }

        // 4. Pasamos el array $data con los libros reales a la vista
        return view($vista, $data);
    }
}