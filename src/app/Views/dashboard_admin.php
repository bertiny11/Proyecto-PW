<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - BookLoop</title>
    <link rel="stylesheet" href="<?= base_url('dashboard.css') ?>">
</head>
<body>

    <div class="main-container">
        <header class="list-header">
            <div class="logo">
                <h1 style="font-size: 1.5rem;"><span>Book</span>Loop</h1>
                <p style="margin: 0; font-size: 0.8rem; font-weight: bold;">Panel de Control: Administrador | Hola, <?= session()->get('nombre') ?></p>
            </div>
            <nav class="nav-menu">
                <a href="#" class="nav-link">Estadísticas Globales</a>
                <a href="<?= base_url('/logout') ?>" class="btn-secondary" style="text-decoration: none; display: inline-block;">Cerrar Sesión</a>
            </nav>
        </header>

        <div class="dashboard-grid-admin">   
            <div class="dashboard-section" style="border-left-color: #8b5cf6;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h2>Gestión de Usuarios</h2>
                    <button class="btn-action" style="width: auto; padding: 0.4rem 1rem; font-size: 0.85rem; background-color: #8b5cf6;">+ Crear Administrador</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre Completo</th>
                            <th>Email Privado</th> <th>Rol Actual</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Carlos Ruiz</td>
                            <td>carlos.ruiz@uca.es</td>
                            <td><span class="badge" style="background:#e0e7ff; color:#3730a3;">Usuario</span></td>
                            <td>
                                <button class="btn-small btn-warning">Hacer Admin</button> <button class="btn-small btn-danger">Banear</button> </td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>Marcos Fuentes</td>
                            <td>marcos.fuentes@uca.es</td>
                            <td><span class="badge" style="background:#e0e7ff; color:#3730a3;">Usuario</span></td>
                            <td>
                                <button class="btn-small btn-warning">Hacer Admin</button> <button class="btn-small btn-danger">Banear</button> </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        <div class="grid-dos-columnas">
                <div class="dashboard-section" style="border-left-color: #8b5cf6;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h2>Moderación de Contenido</h2>
                    <div class="button-group">
                        <a href="<?= base_url('/libros/listado') ?>" class="nav-link">Catálogo</a>
                        <button class="btn-action" style="padding: 0.4rem 1rem; font-size: 0.85rem; background-color: #8b5cf6;">+ Subir Libro</button>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Entidad</th>
                            <th>Incidencia</th>
                            <th>Acción de Administrador</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Libro: "El Quijote"</td>
                            <td>Reporte de falsificación</td>
                            <td><button class="btn-small btn-danger">Eliminar Libro</button></td> 
                        </tr>
                        <tr>
                            <td>Libro: "Física Cuántica"</td>
                            <td>ISBN Incorrecto</td>
                            <td><button class="btn-small" style="background:#e5e7eb;">Editar Libro</button></td> </tr>
                    </tbody>
                </table>
            </div>

            <div class="dashboard-section" style="border-left-color: #8b5cf6;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h2>Control de Préstamos</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Identificador Préstamo</th>
                            <th>Acción de Administrador</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ID 4052</td>
                            <td><button class="btn-small btn-warning">Forzar Devolución</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>

</body>
</html>