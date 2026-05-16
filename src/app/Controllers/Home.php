<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = session();

        // Si no hay sesión activa, lo mandamos de vuelta al login
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view(vista_dashboard_por_rol(rol_actual()));
    }
}