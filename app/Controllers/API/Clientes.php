<?php

namespace App\Controllers\API;

use App\Models\ClientesM;
use CodeIgniter\RESTful\ResourceController;

class Clientes extends ResourceController
{
    public function __construct(){
        $this->model = $this->setModel(new ClientesM());
    }

   public function index() {
       $clientes  = $this->model->findAll();
       return $this->respond($clientes);
   }

   public function crear()
   {
       try {
           $cliente = $this->request->getJSON();
           if($this->model->insert($cliente)):
            $cliente->Id = $this->model->insertID();
              return $this->respondCreated($cliente);
           else:
               return $this->failValidationError($this->model->validation->listErrors());
           endif;
       } catch (\Exception $e) {
           return $this->failServerError('Ha ocurrido un error en el servidor'.$e);
       }
   }

public function editar($Id = null)
   {
       try {
           if($Id == null)
           return $this->failValidationError('No se ha pasado un Id valido');

           $clientev = $this->model->find($Id);
           if($clientev == null)
           return $this->failNotFound('No se ha encontrado con el id: '.$Id);

       $cliente = $this->request->getJSON();
       
       if($this->model->update($Id, $cliente)):
           $cliente->Id = $Id;
        return $this->respondUpdated($cliente);
       else:
           return $this->failValidationError($this->model->validation->listErrors());
      endif;
    } catch (\Exception $e) {
        return $this->failServerError('Ha ocurrido un error en el servidor'.$e);
        
   }

}
public function show($id = null) {
    return $this->respond($this->model->find($id), null, 200);    
}
public function eliminar($Id = null)
   {
       try {
           if($Id == null)
           return $this->failValidationError('No se ha pasado un Id valido');

           $clientev = $this->model->find($Id);
           if($clientev == null)
           return $this->failNotFound('No se ha encontrado con el id: '.$Id);
       
       if($this->model->delete($Id)):
        return $this->respondDeleted($clientev);
       else:
           return $this->failServerError('No se ha podido eliminar el registro');
      endif;
    } catch (\Exception $e) {
        return $this->failServerError('Ha ocurrido un error en el servidor');
        
   }
   }
}
