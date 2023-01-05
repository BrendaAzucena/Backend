<?php

namespace App\Controllers\API;

use App\Models\ClientesM;
use App\Models\FacturasM;
use CodeIgniter\RESTful\ResourceController;

class Facturas extends ResourceController
{
    public function __construct(){
        $this->model = $this->setModel (new FacturasM());
    }

   public function index() {
       $facturas  = $this->model->findAll();
       return $this->respond($facturas);
   }

   public function crear()
   {
       try {
           $factura = $this->request->getJSON();
           if($this->model->insert($factura)):
            $factura->Id = $this->model->insertID();
              return $this->respondCreated($factura);
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

           $facturav = $this->model->find($Id);
           if($facturav == null)
           return $this->failNotFound('No se ha encontrado con el id: '.$Id);

       $factura = $this->request->getJSON();
       
       if($this->model->update($Id, $factura)):
           $factura->Id = $Id;
        return $this->respondUpdated($factura);
       else:
           return $this->failValidationError($this->model->validation->listErrors());
      endif;
    } catch (\Exception $e) {
        return $this->failServerError('Ha ocurrido un error en el servidor');
        
   }

}

public function eliminar($id = null)
   {
       try {
           if($id == null)
           return $this->failValidationError('No se ha pasado un Id valido');

           $facturav = $this->model->find($id);
           if($facturav == null)
           return $this->failNotFound('No se ha encontrado con el id: '.$id);
       
       if($this->model->delete($id)):
        return $this->respondDeleted($facturav);
       else:
           return $this->failServerError('No se ha podido eliminar el registro');
      endif;
    } catch (\Exception $e) {
        return $this->failServerError('Ha ocurrido un error en el servidor');
        
   }
   }

   public function selectCliente($Id = null)
   {
    try{
        $modelCliente = new ClientesM();
        if ($Id == null)
        return $this->failValidationErrors('No se ha pasado un Id valido');
        
        $cliente = $modelCliente->find($Id);
            
        if($cliente == null)
        return $this->failNotFound('No se ha encontrado con el id factura: '.$Id);

            $facturas = $this->model->Relacion($Id);
            
            return $this->respond($facturas);
    } catch (\Exception $e) {
        return $this->failServerError('Ha ocurrido un error en el servidor');
    }

   }

}
