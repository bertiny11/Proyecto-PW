<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BookLoop - Iniciar Sesión</title>
    <!-- El framework genera la URL absoluta hacia la carpeta public -->
    <link rel="stylesheet" href="<?= base_url('style.css') ?>">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo">
                <h1>Book<span>Loop</span></h1>
                <p>Tu biblioteca universitaria compartida</p>
            </div>
            
            <!-- Cambiamos el id="loginForm" por action y method -->
            <form action="<?= base_url('login/procesar') ?>" method="POST">
                <!-- Mostrar errores de sesión si los hay -->
                <?php if(session()->getFlashdata('error')): ?>
                    <div style="background-color: #ffebee; color: #e74c3c; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 0.9rem; text-align: center;">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <div class="input-group">
                    <label for="email">Correo Electrónico</label>
                    <!-- Añadido name="email" para que el Controlador pueda leerlo -->
                    <input type="email" name="email" id="email" placeholder="usuario@uca.es" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <!-- Añadido name="password" -->
                    <input type="password" name="password" id="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-login">Entrar a BookLoop</button>
                
                <div class="footer-links">
                    <a href="#">¿Olvidaste tu contraseña?</a>
                    <span>·</span>
                    <a href="#">Crear cuenta</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>