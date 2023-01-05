<?php

namespace App\Controllers\API;

use App\Models\ProveedoresM;
use CodeIgniter\RESTful\ResourceController;

class Proveedores extends ResourceController
{
    public function __construct(){
        $this->model = $this->setModel(new ProveedoresM());
    }

   public function index() {
       $proveedores  = $this->model->findAll();
       return $this->respond($proveedores);
   }

   public function crear()
   {
       try {
           $proveedor = $this->request->getJSON();
           if($this->model->insert($proveedor)):
            $proveedor->Id = $this->model->insertID();
              return $this->respondCreated($proveedor);
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

           $clienteVerificado = $this->model->find($Id);
           if($clienteVerificado == null)
           return $this->failNotFound('No se ha encontrado con el id: '.$Id);

       $proveedor = $this->request->getJSON();
       
       if($this->model->update($Id, $proveedor)):
           $proveedor->Id = $Id;
        return $this->respondUpdated($proveedor);
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

           $proveedorv = $this->model->find($Id);
           if($proveedorv == null)
           return $this->failNotFound('No se ha encontrado con el id: '.$Id);
       
       if($this->model->delete($Id)):
        return $this->respondDeleted($proveedorv);
       else:
           return $this->failServerError('No se ha podido eliminar el registro');
      endif;
    } catch (\Exception $e) {
        return $this->failServerError('Ha ocurrido un error en el servidor');
        
   }
   }


}
