<?php namespace App\Models;

use CodeIgniter\Model;

class ProductosM extends Model {
    protected $table = 'producto';
    protected $primaryKey = 'Id';

    protected $returnType = 'array';
    protected $allowedFields = ['Precio', 'Descripcion','Categoria','proveedores_Id'];
    protected $validationRules = [
        'Precio' => 'required|min_length[1]|max_length[75]|',
        'Descripcion' => 'required|min_length[1]|max_length[75]|',
        'Categoria' => 'required|min_length[1]|max_length[75]|',
        'proveedores_Id' => 'required|min_length[1]|max_length[75]|',
        
    ];


    protected $skipValidation = false;
    public function Relacion($proveedorId = null)
    {
       $builder = $this->db->table($this->table);
        
     
        $builder->select('producto.Id , producto.Precio, producto.Descripcion, producto.Categoria ');    
        $builder->select('proveedores.Id AS nombre , proveedores.Nombre, proveedores.Apellidos');    
        

        $builder->join('proveedores', 'producto.proveedores_Id = proveedores.Id');
        $builder->where('proveedores.Id' ,$proveedorId);

        $query = $builder->get();
        return $query->getResult(); 
    }

}