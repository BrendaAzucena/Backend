<?php namespace App\Models;

use CodeIgniter\Model;

class ProveedoresM extends Model {
    protected $table = 'proveedores';
    protected $primaryKey = 'Id';

    protected $returnType = 'array';
    protected $allowedFields = ['Nombre', 'Apellidos','Telefono'];

    protected $validationRules = [
        'Nombre' => 'required|min_length[3]|max_length[75]|',
        'Apellidos' => 'required|min_length[3]|max_length[75]|',
        'Telefono' => 'required|min_length[8]|max_length[20]|',
        
    ];

    protected $skipValidation = false;
}