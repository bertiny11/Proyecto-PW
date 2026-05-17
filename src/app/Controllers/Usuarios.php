<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuarios extends BaseController
{
    public function hacerAdmin($idUsuario)
    {
        // Esta funcion solo puede hacerla el admin. 
        if (!usuario_logueado() || rol_actual() !== 'Administrador') {
            return redirect()->to('/login');
        }

        $usuarioModel = new UsuarioModel();

        // Evitamos modificar el propio rol del admin logueado. 
        if ((int) $idUsuario === (int) session()->get('id_usuario')) {
            return redirect()->to('/admin/dashboard')->with('error', 'No necesitas cambiar tu propio rol.');
        }

        // Convertimos al usuario seleccionado en administrador. 
        $usuarioModel->update($idUsuario, [
            'Rol' => 'Administrador',
        ]);

        return redirect()->to('/admin/dashboard')->with('mensaje', 'Usuario convertido en administrador.');
    }

    public function banear($idUsuario)
    {
        if (!usuario_logueado() || rol_actual() !== 'Administrador') {
            return redirect()->to('/login');
        }

        // Evitamos que el propio administrador se banee a si mismo. 
        if ((int) $idUsuario === (int) session()->get('id_usuario')) {
            return redirect()->to('/admin/dashboard')->with('error', 'No puedes banear tu propia cuenta.');
        }

        $usuarioModel = new UsuarioModel();

        // Marcamos como baneado al usuario. 
        $usuarioModel->update($idUsuario, [
            'Estado_Usuario' => 'Baneado',
        ]);

        return redirect()->to('/admin/dashboard')->with('mensaje', 'Usuario baneado correctamente.');
    }

    public function desbanear($idUsuario)
    {
        if (!usuario_logueado() || rol_actual() !== 'Administrador') {
            return redirect()->to('/login');
        }

        $usuarioModel = new UsuarioModel();

        // Volvemos a dejar la cuenta del usuario activa. 
        $usuarioModel->update($idUsuario, [
            'Estado_Usuario' => 'Activo',
        ]);

        return redirect()->to('/admin/dashboard')->with('mensaje', 'Usuario reactivado correctamente.');
    }

}