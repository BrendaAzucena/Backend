<?php namespace App\Models;

use CodeIgniter\Model;

class ClientesM extends Model {
    protected $table = 'cliente';
    protected $primaryKey = 'Id';

    protected $returnType = 'array';
    protected $allowedFields = ['Nombre', 'Apellidos','Telefono','Direccion'];    

    protected $validationRules = [
        'Nombre' => 'required|min_length[3]|max_length[75]|',
        'Apellidos' => 'required|min_length[3]|max_length[75]|',
        'Telefono' => 'required|min_length[8]|max_length[75]|',
        'Direccion' => 'required|min_length[3]|max_length[75]|',
        
    ];

    protected $skipValidation = false;


}
