<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Panel (Usuario) - BookLoop</title>
    <link rel="stylesheet" href="<?= base_url('dashboard.css') ?>">
</head>
<body>

    <div class="main-container">
        <header class="list-header">
            <div class="logo">
                <h1 style="font-size: 1.5rem;">Book<span>Loop</span></h1>
                <p style="margin: 0; font-size: 0.8rem;">Modo: Usuario Estándar | Hola, <?= session()->get('nombre') ?></p>
            </div>
            <nav class="nav-menu">
                <?php if (tiene_permiso('ver_catalogo')):?>
                    <a href="<?= base_url('libros/listado') ?>" class="nav-link">Catálogo</a>
                <?php endif; ?>
                
                <?php if (tiene_permiso('ver_mi_perfil')):?>
                    <a href="#" class="nav-link">Mi Perfil</a>
                <?php endif; ?>

                <a href="<?= base_url('/logout') ?>" class="btn-secondary" style="text-decoration: none; display: inline-block;">Cerrar Sesión</a>
            </nav>
        </header>

        <div class="dashboard-grid-user">
            <div class="dashboard-section">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <h2>Mis Libros Subidos</h2>
                    <?php if (tiene_permiso('crear_libro')):?>
                        <a href="<?= base_url('libros/crear') ?>" class="btn-action" style="text-decoration: none; display: inline-block; width: auto; padding: 0.4rem 1rem; font-size: 0.85rem; text-align: center; color: white;">+ Subir Libro</a>
                    <?php endif; ?>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Estado</th>
                            <th>Acciones Permitidas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($libros_propios) && is_array($libros_propios)): ?>
                            <?php foreach ($libros_propios as $libro): ?>
                                <tr>
                                    <td><?= esc($libro['titulo']) ?></td>
                                    <td>
                                        <?php if ($libro['disponibilidad'] === 'Disponible' || $libro['disponibilidad'] == 1): ?>
                                            <span class="badge available">En mi poder</span>
                                        <?php else: ?>
                                            <span class="badge borrowed">Prestado</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (tiene_permiso('editar_libro_propio')):?>
                                            <a href="<?= base_url('libros/editar/' . $libro['id_libro']) ?>" class="action-link">Editar</a>
                                        <?php endif; ?>

                                        <?php if (tiene_permiso('eliminar_libro_propio')):?>
                                            <?php if ($libro['disponibilidad'] === 'Disponible' || $libro['disponibilidad'] == 1): ?>
                                                <a href="<?= base_url('libros/borrar/' . $libro['id_libro']) ?>" class="action-link danger" onclick="return confirm('¿Deseas retirar este libro del catálogo de BookLoop?')">Borrar</a> 
                                            <?php else: ?>
                                                <span class="action-link disabled" title="No puedes borrar un libro que está prestado actualmente">Borrar</span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" style="text-align: center; color: #9ca3af; padding: 2rem 0;">
                                    Aún no has incorporado ningún libro a tu catálogo particular.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="dashboard-section">
                <h2>Mis Préstamos</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Libro Solicitado</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($mis_prestamos)): ?>
                            <?php foreach ($mis_prestamos as $prestamo): ?>
                                <tr>
                                    <td><?= esc($prestamo['titulo']) ?></td>
                                    <td><?= esc($prestamo['estado_prestamo']) ?></td>
                                    <td>
                                        <?php if (tiene_permiso('devolver_prestamo_propio') && $prestamo['estado_prestamo'] === 'Activo'): ?>
                                            <a href="<?= base_url('prestamos/devolver/' . $prestamo['id_prestamo']) ?>"class="btn-secondary"style="padding: 0.3rem; font-size: 0.75rem; text-decoration:none;"
                                            onclick="return confirm('¿Confirmas que has devuelto este libro?')"> Marcar Devuelto
                                            </a>
                                        <?php else: ?>
                                            <span class="badge borrowed">Pendiente</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No tienes préstamos activos.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <br>

                <h2>Mis Solicitudes Recibidas</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Libro</th>
                            <th>Solicitante</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($solicitudes_recibidas)): ?>
                            <?php foreach ($solicitudes_recibidas as $solicitud): ?>
                                <tr>
                                    <td><?= esc($solicitud['titulo']) ?></td>
                                    <td><?= esc($solicitud['nombre_prestatario']) ?></td>
                                    <td>
                                        <?php if (tiene_permiso('aceptar_solicitudes_propias')): ?>
                                            <a href="<?= base_url('prestamos/aceptar/' . $solicitud['id_prestamo']) ?>"class="btn-action"style="padding: 0.3rem; font-size: 0.75rem; text-decoration:none; color:white;"
                                            onclick="return confirm('¿Aceptar esta solicitud de préstamo?')"> Aceptar
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No tienes solicitudes pendientes.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>