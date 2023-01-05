<?php namespace App\Models;

use CodeIgniter\Model;

class FacturasM extends Model {
    protected $table = 'factura';
    protected $primaryKey = 'Id';

    protected $returnType = 'array';
    protected $allowedFields = ['Fecha', 'Descuento','Cantidad','cliente_Id'];
    protected $validationRules = [
        'Fecha' => 'required|min_length[3]|max_length[75]|',
        'Descuento' => 'required|min_length[3]|max_length[75]|',
        'Cantidad' => 'required|min_length[1]|max_length[75]|',
        'cliente_Id' => 'required|min_length[1]|max_length[75]|',
        
    ];

    protected $skipValidation = false;

  
    public function Relacion($clienteId = null)
    {
       $builder = $this->db->table($this->table);
        
     
        $builder->select('factura.Id , factura.Fecha, factura.Descuento, factura.Cantidad ');    
        $builder->select('cliente.Id AS nombre , cliente.Nombre, cliente.Apellidos');    
        

        $builder->join('cliente', 'factura.cliente_Id = cliente.Id');
        $builder->where('cliente.Id' ,$clienteId);

        $query = $builder->get();
        return $query->getResult(); 
    }
}