<?php namespace App\Models;

use CodeIgniter\Model;

class VentasM extends Model {
    protected $table = 'venta';
    protected $primaryKey = 'Id';

    protected $returnType = 'array';
    protected $allowedFields = ['Cantidad', 'factura_Id'];

    protected $validationRules = [
        'Cantidad' => 'required|min_length[1]|max_length[75]|',
        'factura_Id' => 'required|min_length[1]|max_length[75]|',
        
    ];

    protected $skipValidation = false;

    public function Relacion($facturaId = null)
    {
       $builder = $this->db->table($this->table);
        
     
        $builder->select('venta.Id , venta.Cantidad, venta.factura_Id ');    
        $builder->select('venta.Id AS nombre , factura.Fecha, factura.Descuento');    
        

        $builder->join('factura', 'venta.factura_Id = factura.Id');
        $builder->where('factura.Id' ,$facturaId);

        $query = $builder->get();
        return $query->getResult(); 
    }
}
