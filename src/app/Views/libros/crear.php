<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir un nuevo libro - BookLoop</title>
    <link rel="stylesheet" href="<?= base_url('listado.css') ?>">
</head>
<body class="form-layout-body">

    <div class="mockup-card">
        <h2 class="mockup-title">Añadir un nuevo libro</h2>
        <p class="mockup-subtitle">Completa los datos para ofrecer tu libro a la comunidad.</p>

        <form action="<?= base_url('libros/guardar') ?>" method="POST">
            <div class="form-group">
                <label for="titulo">Título del Libro *</label>
                <input type="text" id="titulo" name="titulo" required placeholder="Ej. El Quijote">
            </div>

            <div class="form-group">
                <label for="autor">Autor *</label>
                <input type="text" id="autor" name="autor" required placeholder="Ej. Miguel de Cervantes">
            </div>

            <div class="form-group">
                <label for="isbn">Código ISBN</label>
                <input type="text" id="isbn" name="isbn" placeholder="Ej. 978-84-376-0494-7">
                <span class="help-text">Suele estar encima del código de barras.</span>
            </div>

            <div class="form-group">
                <label for="estado">Estado Físico *</label>
                <select id="estado" name="estado" required>
                    <option value="" disabled selected>Selecciona el estado...</option>
                    <option value="Nuevo">Nuevo</option>
                    <option value="Buen estado">Buen estado</option>
                    <option value="Usado">Usado</option>
                </select>
            </div>

            <div class="btn-group-mockup">
                <a href="<?= base_url('libros/listado') ?>" class="btn-mockup-cancel">Cancelar</a>
                <button type="submit" class="btn-mockup-submit">Publicar Libro</button>
            </div>
        </form>
    </div>

</body>
</html>