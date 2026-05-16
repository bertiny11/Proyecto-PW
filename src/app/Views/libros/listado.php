<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookLoop - Catálogo</title>
    <link rel="stylesheet" href="<?= base_url('listado.css') ?>">
</head>
<body>

    <header class="mockup-navbar">
        <div class="navbar-inner">
            <a href="<?= base_url('/') ?>" class="mockup-logo">Book<span>Loop</span></a>
            <div class="nav-right">
                <a href="<?= base_url('/') ?>" class="nav-link-item">Inicio</a>
                <button class="btn-profile">Mi Perfil</button>
                <a href="<?= base_url('libros/crear') ?>" class="btn-upload-head">Subir Libro</a>
            </div>
        </div>
    </header>

    <div class="catalog-container">
        <div class="search-filter-row">
            <input type="text" class="mockup-search-bar" placeholder="Buscar por título, autor o ISBN...">
            <select class="mockup-filter-select">
                <option>Todos los estados</option>
            </select>
        </div>

        <div class="mockup-book-grid">
            <?php if (!empty($libros) && is_array($libros)): ?>
                <?php foreach ($libros as $libro): ?>
                    <div class="mockup-book-card">
                        <div class="card-top">
                            <h3><?= esc($libro['titulo']) ?></h3>
                            <p class="author"><?= esc($libro['autor']) ?></p>
                            <p class="isbn">ISBN: <?= esc($libro['isbn']) ?></p>
                            <span class="mockup-badge <?= $libro['disponibilidad'] === 'Disponible' || $libro['disponibilidad'] == 1 ? 'available' : 'borrowed' ?>">
                                <?= $libro['disponibilidad'] === 'Disponible' || $libro['disponibilidad'] == 1 ? 'Disponible' : 'Prestado' ?>
                            </span>
                        </div>

                        <div class="card-actions">
                            <?php if (rol_actual() === 'Usuario' && session()->get('id_usuario') != $libro['id_propietario']): ?>
                                <?php if ($libro['disponibilidad'] === 'Disponible' || $libro['disponibilidad'] == 1): ?>
                                    <button class="btn-mockup-action success">Solicitar Préstamo</button>
                                <?php else: ?>
                                    <button class="btn-mockup-action disabled" disabled>No Disponible</button>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (rol_actual() === 'Administrador' || session()->get('id_usuario') == $libro['id_propietario']): ?>
                                <div class="crud-flex-group">
                                    <a href="<?= base_url('libros/editar/' . $libro['id_libro']) ?>" class="btn-crud-edit">Editar</a>
                                    <a href="<?= base_url('libros/borrar/' . $libro['id_libro']) ?>" class="btn-crud-delete" onclick="return confirm('¿Seguro?')">Eliminar</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="grid-column: 1 / -1; text-align: center; color: #6b7280;">No hay libros.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>