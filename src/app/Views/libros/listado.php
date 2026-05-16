<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BookLoop - Catálogo</title>
    <link rel="stylesheet" href="<?= base_url('listado.css') ?>">
</head>
<body>

    <header class="navbar">
        <div class="logo"><h1>Book<span>Loop</span></h1></div>
        <div class="nav-links">
            <a href="#">Inicio</a>
            <button class="btn-outline">Mi Perfil</button>
            <?php if (session()->get('rol') == 'admin'): ?>
                <button class="btn-dark">Subir Libro</button>
            <?php endif; ?>
        </div>
    </header>

    <div class="search-container">
        <input type="text" class="search-bar" placeholder="Buscar por título, autor o ISBN...">
        <select class="filter-select">
            <option>Todos los estados</option>
        </select>
    </div>

    <div class="main-content">
        <div class="book-grid">
            <?php foreach ($libros as $libro): ?>
                <div class="book-card">
                    <h3><?= $libro['titulo'] ?></h3>
                    <p class="author"><?= $libro['autor'] ?></p>
                    <p class="isbn">ISBN: <?= $libro['isbn'] ?></p>
                    
                    <span class="badge <?= $libro['disponibilidad'] ? 'available' : 'borrowed' ?>">
                        <?= $libro['disponibilidad'] ? 'Disponible' : 'Prestado' ?>
                    </span>

                    <div class="admin-actions">
                        <?php if (session()->get('rol') == 'usuario'): ?>
                            <button class="btn-action">Solicitar Préstamo</button>
                        <?php endif; ?>

                        <?php if (session()->get('rol') == 'admin'): ?>
                            <a href="#" class="btn-edit">Editar</a>
                            <a href="#" class="btn-delete">Eliminar</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>