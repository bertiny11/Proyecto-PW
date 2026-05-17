<?php

namespace App\Models;

use CodeIgniter\Model;

class PrestamoModel extends Model
{
    protected $table      = 'prestamos';
    protected $primaryKey = 'id_prestamo';

    protected $returnType = 'array';

    protected $allowedFields = [
        'id_libro',
        'id_prestatario',
        'fecha_inicio',
        'fecha_fin',
        'estado_prestamo',
        'created_at',
    ];
}