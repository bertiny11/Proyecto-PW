<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - BookLoop</title>
    <link rel="stylesheet" href="<?= base_url('login.css') ?>">
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <h1>Book<span>Loop</span></h1>
            <p>Tu biblioteca universitaria compartida</p>
        </div>

        <?php if(session()->getFlashdata('msg')):?>
            <div class="error-msg"><?= session()->getFlashdata('msg') ?></div>
        <?php endif;?>

        <form action="<?= base_url('/login/procesar') ?>" method="post">
            <div class="form-group">
                <label>Correo Electrónico</label>
                <input type="email" name="email" placeholder="usuario@uca.es" required>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="********" required>
            </div>
            <button type="submit" class="btn-action">Entrar a BookLoop</button>
        </form>
        <div class="form-footer-links">
            <a href="#">¿Olvidaste tu contraseña?</a> · 
            <a href="#">Crear cuenta</a>
        </div>
    </div>
</body>
</html>