<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar libro - BookLoop</title>
    <link rel="stylesheet" href="<?= base_url('listado.css') ?>">
</head>
<body class="form-layout-body">

    <div class="mockup-card">
        <h2 class="mockup-title">Modificar tu libro</h2>
        <p class="mockup-subtitle">Actualiza la información del ejemplar seleccionado en el catálogo.</p>

        <form action="<?= base_url('libros/actualizar/' . $libro['id_libro']) ?>" method="POST">
            <div class="form-group">
                <label for="titulo">Título del Libro *</label>
                <input type="text" id="titulo" name="titulo" value="<?= esc($libro['titulo']) ?>" required>
            </div>

            <div class="form-group">
                <label for="autor">Autor *</label>
                <input type="text" id="autor" name="autor" value="<?= esc($libro['autor']) ?>" required>
            </div>

            <div class="form-group">
                <label for="isbn">Código ISBN</label>
                <input type="text" id="isbn" name="isbn" value="<?= esc($libro['isbn']) ?>">
                <span class="help-text">Suele estar encima del código de barras.</span>
            </div>

            <div class="form-group">
                <label for="estado">Estado Físico *</label>
                <select id="estado" name="estado" required>
                    <option value="Nuevo" <?= $libro['estado'] === 'Nuevo' ? 'selected' : '' ?>>Nuevo</option>
                    <option value="Buen estado" <?= $libro['estado'] === 'Buen estado' ? 'selected' : '' ?>>Buen estado</option>
                    <option value="Usado" <?= $libro['estado'] === 'Usado' ? 'selected' : '' ?>>Usado</option>
                </select>
            </div>

            <div class="btn-group-mockup">
                <a href="<?= base_url('libros/listado') ?>" class="btn-mockup-cancel">Cancelar</a>
                <button type="submit" class="btn-mockup-submit">Guardar Cambios</button>
            </div>
        </form>
    </div>

</body>
</html>