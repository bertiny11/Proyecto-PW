<?php

namespace App\Models;

use CodeIgniter\Model;

class LibroModel extends Model
{
    // 1. Le decimos cómo se llama la tabla en MySQL
    protected $table            = 'libros';

    // 2. Le indicamos cuál es la clave primaria
    protected $primaryKey       = 'id_libro';

    // 3. (MUY IMPORTANTE) Los campos que CodeIgniter tiene permiso para modificar
    protected $allowedFields = ['titulo', 'autor', 'isbn', 'estado', 'disponibilidad', 'id_propietario'];

    // (Opcional) Si quieres que CodeIgniter maneje automáticamente las fechas de creación
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = ''; // Lo dejamos vacío si no tienes columna updated_at
}