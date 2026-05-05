<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // 1. Intentamos conectar a la base de datos
        $db = \Config\Database::connect();
        
        try {
            $db->initialize();
            $mensaje_db = "<h3 style='color: green;'>¡Conexión a MySQL exitosa desde Docker! 🐳</h3>";
        } catch (\Throwable $e) {
            $mensaje_db = "<h3 style='color: red;'>Error de conexión: " . $e->getMessage() . "</h3>";
        }

        // 2. Mostramos un mensaje sencillo en pantalla
        echo "<div style='text-align: center; margin-top: 50px; font-family: Arial;'>";
        echo "<h1>Mi Proyecto CodeIgniter</h1>";
        echo $mensaje_db;
        echo "<p>Si ves el mensaje en verde, ya puedes empezar a crear tablas.</p>";
        echo "</div>";
    }
}