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

        // Leemos el rol del usuario desde la sesión
        $rol = $session->get('rol');

        // Redirigimos al panel correspondiente
        if ($rol === 'Administrador') {
            return view('dashboard_admin');
        } else {
            return view('dashboard_usuario');
        }
    }
}