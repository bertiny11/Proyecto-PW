<?php

namespace App\Controllers;

use App\Models\LibroModel;

class Libros extends BaseController
{
    public function index()
    {
        helper('url');
        $model = new LibroModel();

        // ⚡ MODIFICACIÓN CRÍTICA: Filtro de exclusión por propietario
        if (rol_actual() === 'Usuario') {
            $id_usuario_actual = session()->get('id_usuario');
            
            // Traemos solo los libros que pertenecen a otros usuarios (o que no tengan dueño asignado)
            $libros = $model->where('id_propietario !=', $id_usuario_actual)
                            ->orWhere('id_propietario', null)
                            ->findAll();
        } else {
            // Si es Administrador, mantiene la supervisión completa de todo el catálogo
            $libros = $model->findAll();
        }

        $data = [
            'titulo' => "Catálogo de BookLoop",
            'libros' => $libros 
        ];

        return view('libros/listado', $data); 
    }

    public function crear()
    {
        helper('url');
        $data = [
            'titulo' => "Añadir Nuevo Libro a BookLoop"
        ];
        return view('libros/crear', $data);
    }

    public function guardar()
    {
        $model = new LibroModel();

        $model->save([
            'titulo'         => $this->request->getPost('titulo'),
            'autor'          => $this->request->getPost('autor'),
            'isbn'           => $this->request->getPost('isbn'),
            'estado'         => $this->request->getPost('estado'),
            'disponibilidad' => 'Disponible',
            'id_propietario' => session()->get('id_usuario')
        ]);

        return redirect()->to('/libros/listado');
    }

    public function editar($id)
    {
        helper('url');
        $model = new LibroModel();
        $libro = $model->find($id);

        if (rol_actual() !== 'Administrador' && session()->get('id_usuario') != $libro['id_propietario']) {
            return redirect()->to('/libros/listado');
        }

        $data = [
            'titulo' => "Modificar Libro",
            'libro'  => $libro
        ];

        return view('libros/editar', $data);
    }

    public function actualizar($id)
    {
        $model = new LibroModel();
        $libro = $model->find($id);

        if (rol_actual() !== 'Administrador' && session()->get('id_usuario') != $libro['id_propietario']) {
            return redirect()->to('/libros/listado');
        }

        $model->update($id, [
            'titulo' => $this->request->getPost('titulo'),
            'autor'  => $this->request->getPost('autor'),
            'isbn'   => $this->request->getPost('isbn'),
            'estado' => $this->request->getPost('estado')
        ]);

        return redirect()->to('/libros/listado');
    }

    public function borrar($id)
    {
        $model = new LibroModel();
        $libro = $model->find($id);

        if (rol_actual() !== 'Administrador' && session()->get('id_usuario') != $libro['id_propietario']) {
            return redirect()->to('/libros/listado');
        }

        $model->delete($id);
        return redirect()->to('/libros/listado');
    }
}