<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    // 1. ¿Cómo se llama la tabla en MySQL?
    protected $table            = 'usuarios';
    
    // 2. ¿Cuál es la clave primaria (PK)?
    protected $primaryKey       = 'ID_Usuario';
    
    // 3. ¿Es autoincremental?
    protected $useAutoIncrement = true;
    
    // 4. ¿Cómo queremos que nos devuelva los datos? (En forma de Array)
    protected $returnType       = 'array';
    
    // 5. ESCUDO DE SEGURIDAD: ¿Qué columnas permitimos que se puedan rellenar o modificar desde un formulario?
    protected $allowedFields    = [
        'Nombre_Apellido', 
        'Email', 
        'Contrasena', 
        'Rol', 
        'Estado_Usuario',
        'Ubicacion'
    ];
}