<?php

namespace App\Controllers;

class MiProyecto extends BaseController
{
    public function index()
    {
        // Aquí le decimos que cargue una vista (una página HTML)
        return view('mi_primera_vista');
    }
}