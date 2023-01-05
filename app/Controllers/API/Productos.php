<?php

namespace App\Controllers\API;

use App\Models\ProductosM;
use App\Models\ProveedoresM;
use CodeIgniter\RESTful\ResourceController;

class Productos extends ResourceController
{
    public function __construct(){
        $this->model = $this->setModel(new ProductosM());
    }

   public function index() {
       $productos  = $this->model->findAll();
       return $this->respond($productos);
   }

   public function crear()
   {
       try {
           $producto = $this->request->getJSON();
           if($this->model->insert($producto)):
            $producto->Id = $this->model->insertID();
              return $this->respondCreated($producto);
           else:
               return $this->failValidationError($this->model->validation->listErrors());
           endif;
       } catch (\Exception $e) {
           return $this->failServerError('Ha ocurrido un error en el servidor');
       }
   }
   
   public function show($id = null) {
    return $this->respond($this->model->find($id), null, 200);    
}
public function editar($Id = null)
   {
       try {
           if($Id == null)
           return $this->failValidationError('No se ha pasado un Id valido');

           $productov = $this->model->find($Id);
           if($productov == null)
           return $this->failNotFound('No se ha encontrado con el id: '.$Id);

       $producto = $this->request->getJSON();
       
       if($this->model->update($Id, $producto)):
           $producto->Id = $Id;
        return $this->respondUpdated($producto);
       else:
           return $this->failValidationError($this->model->validation->listErrors());
      endif;
    } catch (\Exception $e) {
        return $this->failServerError('Ha ocurrido un error en el servidor');
        
   }

}

public function eliminar($Id = null)
   {
       try {
           if($Id == null)
           return $this->failValidationError('No se ha pasado un Id valido');

           $productov = $this->model->find($Id);
           if($productov == null)
           return $this->failNotFound('No se ha encontrado con el id: '.$Id);
       
       if($this->model->delete($Id)):
        return $this->respondDeleted($productov);
       else:
           return $this->failServerError('No se ha podido eliminar el registro');
      endif;
    } catch (\Exception $e) {
        return $this->failServerError('Ha ocurrido un error en el servidor');
        
   }
   }
   
   public function selectProvedores($Id = null)
   {
    try{
        $modelProducto = new ProveedoresM();
        if ($Id == null)
        return $this->failValidationErrors('No se ha pasado un Id valido');
        
        $proveedor = $modelProducto->find($Id);
            
        if($proveedor == null)
        return $this->failNotFound('No se ha encontrado con el id cliente: '.$Id);

            $productos = $this->model->Relacion($Id);
            
            return $this->respond($productos);
    } catch (\Exception $e) {
        return $this->failServerError('Ha ocurrido un error en el servidor');
    }

   }

}
