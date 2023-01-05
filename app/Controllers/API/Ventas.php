<?php

namespace App\Controllers\API;

use App\Models\FacturasM;
use App\Models\VentasM;
use CodeIgniter\RESTful\ResourceController;

class Ventas extends ResourceController
{
    public function __construct(){
        $this->model = $this->setModel(new VentasM());
    }

   public function index() {
       $ventas  = $this->model->findAll();
       return $this->respond($ventas);
   }

   public function crear()
   {
       try {
           $venta = $this->request->getJSON();
           if($this->model->insert($venta)):
            $venta->Id = $this->model->insertID();
              return $this->respondCreated($venta);
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

           $ventav = $this->model->find($Id);
           if($ventav == null)
           return $this->failNotFound('No se ha encontrado con el Id: '.$Id);

       $venta = $this->request->getJSON();
       
       if($this->model->update($Id, $venta)):
           $venta->Id = $Id;
        return $this->respondUpdated($venta);
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

           $ventav = $this->model->find($Id);
           if($ventav == null)
           return $this->failNotFound('No se ha encontrado con el Id: '.$Id);
       
       if($this->model->delete($Id)):
        return $this->respondDeleted($ventav);
       else:
           return $this->failServerError('No se ha podido eliminar el registro');
      endif;
    } catch (\Exception $e) {
        return $this->failServerError('Ha ocurrido un error en el servidor');
        
   }
   }

   public function selectFacturas($Id = null)
   {
    try{
        $modelVenta = new VentasM();
        if ($Id == null)
        return $this->failValidationErrors('No se ha pasado un Id valido');
        
        $facturas = $modelVenta->find($Id);
            
        if($facturas == null)
        return $this->failNotFound('No se ha encontrado con el id venta: '.$Id);

            $ventav = $this->model->Relacion($Id);
            
            return $this->respond($ventav);
    } catch (\Exception $e) {
        return $this->failServerError('Ha ocurrido un error en el servidor');
    }

   }

}
