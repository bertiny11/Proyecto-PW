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
                <?php if (tiene_permiso('ver_estadisticas_globales')): ?>
                    <a href="#" class="nav-link">Estadísticas Globales</a>
                <?php endif; ?>
                <a href="<?= base_url('/logout') ?>" class="btn-secondary" style="text-decoration: none; display: inline-block;">Cerrar Sesión</a>
            </nav>
        </header>

        <div class="dashboard-grid-admin">   
            <div class="dashboard-section" style="border-left-color: #8b5cf6;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h2>Gestión de Usuarios</h2>
                    <?php if (tiene_permiso('crear_administrador')): ?>
                        <button class="btn-action" style="width: auto; padding: 0.4rem 1rem; font-size: 0.85rem; background-color: #8b5cf6;">+ Crear Administrador</button>
                    <?php endif; ?>
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
                                <?php if (tiene_permiso('gestionar_usuarios')): ?>
                                    <button class="btn-small btn-warning">Hacer Admin</button> 
                                <?php endif; ?>

                                <?php if (tiene_permiso('banear_usuarios')): ?>
                                    <button class="btn-small btn-danger">Banear</button> 
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>Marcos Fuentes</td>
                            <td>marcos.fuentes@uca.es</td>
                            <td><span class="badge" style="background:#e0e7ff; color:#3730a3;">Usuario</span></td>
                            <td>
                                <?php if (tiene_permiso('gestionar_usuarios')): ?>
                                    <button class="btn-small btn-warning">Hacer Admin</button> 
                                <?php endif; ?>

                                <?php if (tiene_permiso('banear_usuarios')): ?>
                                    <button class="btn-small btn-danger">Banear</button> 
                                <?php endif; ?>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>

        <div class="grid-dos-columnas">
            <div class="dashboard-section" style="border-left-color: #8b5cf6;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h2>Moderación de Contenido</h2>
                    <div class="button-group">
                        <?php if (tiene_permiso('ver_catalogo')): ?>
                            <a href="<?= base_url('libros/listado') ?>" class="nav-link">Catálogo</a>
                        <?php endif; ?>

                        <?php if (tiene_permiso('crear_libro')): ?>
                            <a href="<?= base_url('libros/crear') ?>" class="btn-action" style="text-decoration: none; display: inline-block; padding: 0.4rem 1rem; font-size: 0.85rem; background-color: #8b5cf6; color: white; text-align: center;">+ Subir Libro</a>
                        <?php endif; ?>
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
                            <td>
                                <?php if (tiene_permiso('eliminar_cualquier_libro')): ?>
                                    <a href="<?= base_url('libros/borrar/1') ?>" class="btn-small btn-danger" style="text-decoration: none; display: inline-block;" onclick="return confirm('¿Eliminar este libro de forma definitiva?')">Eliminar Libro</a> 
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Libro: "Física Cuántica"</td>
                            <td>ISBN Incorrecto</td>
                            <td>
                                <?php if (tiene_permiso('editar_cualquier_libro')): ?>
                                    <a href="<?= base_url('libros/editar/2') ?>" class="btn-small" style="background:#e5e7eb; text-decoration: none; display: inline-block; color: #333;">Editar Libro</a>
                                <?php endif; ?>
                            </td>
                        </tr>
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
                            <td>
                                <?php if(tiene_permiso('forzar_devoluciones')): ?>
                                    <button class="btn-small btn-warning">Forzar Devolución</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>

</body>
</html>