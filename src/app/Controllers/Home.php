<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
{
    if (!usuario_logueado()) {
        return redirect()->to('/login');
    }

    $vista = vista_dashboard_por_rol(rol_actual());
    return view($vista);

    }
}