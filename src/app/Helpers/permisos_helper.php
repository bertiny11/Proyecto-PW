<?php

if (! function_exists('rol_actual')) {
    function rol_actual(): ?string
    {
        return session()->get('rol');
    }
}

if (! function_exists('usuario_logueado')) {
    function usuario_logueado(): bool
    {
        return session()->get('logged_in') === true;
    }
}

if (! function_exists('es_admin')) {
    function es_admin(): bool
    {
        return rol_actual() === 'Administrador';
    }
}

if (! function_exists('es_usuario')) {
    function es_usuario(): bool
    {
        return rol_actual() === 'Usuario';
    }
}

if (! function_exists('permisos_por_rol')) {
    function permisos_por_rol(?string $rol): array
    {
        $permisos = [
            'Administrador' => [
                'ver_dashboard_admin',
                'ver_catalogo',
                'crear_libro',
                'editar_cualquier_libro',
                'eliminar_cualquier_libro',
                'gestionar_usuarios',
                'crear_administrador',
                'banear_usuarios',
                'forzar_devoluciones',
                'ver_estadisticas_globales',
            ],

            'Usuario' => [
                'ver_dashboard_usuario',
                'ver_catalogo',
                'crear_libro',
                'editar_libro_propio',
                'eliminar_libro_propio',
                'solicitar_prestamo',
                'ver_mis_prestamos',
                'aceptar_solicitudes_propias',
                'devolver_prestamo_propio',
                'ver_mi_perfil',
            ],
        ];

        return $permisos[$rol] ?? [];
    }
}

if (! function_exists('tiene_permiso')) {
    function tiene_permiso(string $permiso): bool
    {
        return in_array($permiso, permisos_por_rol(rol_actual()), true);
    }
}

if (! function_exists('vista_dashboard_por_rol')) {
    function vista_dashboard_por_rol(?string $rol): string
    {
        if ($rol === 'Administrador') {
            return 'dashboard_admin';
        }

        if ($rol === 'Usuario') {
            return 'dashboard_usuario';
        }

        return 'login';
    }
}

if (! function_exists('ruta_inicio_por_rol')) {
    function ruta_inicio_por_rol(?string $rol): string
    {
        if ($rol === 'Administrador') {
            return '/admin/dashboard';
        }

        if ($rol === 'Usuario') {
            return '/usuario/dashboard';
        }

        return '/login';
    }
}