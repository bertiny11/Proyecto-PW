<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Login extends BaseController
{
    // Esta función solo dibuja el HTML que creamos en el Paso 4
    public function index()
    {
        return view('login');
    }

    // Esta función se ejecuta cuando el usuario pulsa "Entrar a BookLoop"
    public function procesar()
    {
        $session = session(); // Encendemos el motor de sesiones
        $model = new UsuarioModel(); // Invocamos a tu traductor de la base de datos

        // 1. Recogemos lo que el usuario escribió en el HTML (los atributos name="")
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // 2. Buscamos en MySQL si existe alguien con ese correo
        $usuario = $model->where('Email', $email)->first();

        // 3. Comprobaciones de seguridad
        if ($usuario) {
            // El usuario existe. Ahora verificamos si la contraseña coincide con el hash encriptado
            if (password_verify($password, $usuario['Contrasena'])) {
                
                // ¡Éxito! Guardamos su carnet de identidad en la sesión del servidor
                $datosSesion = [
                    'id_usuario' => $usuario['ID_Usuario'],
                    'nombre'     => $usuario['Nombre_Apellido'],
                    'rol'        => $usuario['Rol'],
                    'logged_in'  => true
                ];
                $session->set($datosSesion);

                // Lo enviamos a la página principal de la biblioteca
                return redirect()->to('/'); 

            } else {
                // Contraseña incorrecta
                $session->setFlashdata('error', 'Contraseña incorrecta.');
                return redirect()->to('/login');
            }
        } else {
            // El email no está en la base de datos
            $session->setFlashdata('error', 'No existe ninguna cuenta con este correo.');
            return redirect()->to('/login');
        }
    }

    // Esta función destruye el carnet de identidad y te echa fuera
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}