<?php

namespace App\Controllers;

use App\Models\LibroModel;

class Libros extends BaseController
{
    public function index()
    {
        helper('url');
        $model = new LibroModel();

        // IMPORTANTE: Los nombres de estas llaves son los que usas en la vista
        $data = [
            'titulo' => "Catálogo de BookLoop",
            'libros' => $model->findAll() // Esto llena la variable $libros
        ];

        // Llamamos a la vista pasando el array $data
        return view('libros/listado', $data); 
    }
}