<?php

namespace App\Controllers;

use App\Models\tareaModel;
use App\Models\subtareaModel;
use App\Models\colorModel;
use App\Models\colorSubtareaModel;
use App\Models\prioridadesSubtareasModel;

class Archivadas extends BaseController
{
    public function index(){
        $sesion = session();
        
        //Si el usuario ya esta logeado
        if($sesion->has('usuario')){
            $tareaModel = new tareaModel();
            $tareas = $tareaModel->traerArchivadas();

            $subtareaModel = new subtareaModel();
            $subtareas = $subtareaModel->traerArchivadas();

            // * Necesarios por campos nulos
            $colores = new colorModel();
            $colores = $colores->traerColoresOrdenadosCodigo();

            $coloressubtareas = new colorSubtareaModel();
            $coloressubtareas = $coloressubtareas->traerColoresSubtareasOrdenadosCodigo();

            $prioridades = new prioridadesSubtareasModel();
            $prioridades = $prioridades->traerPrioridadesOrdenadas();
            // *

            $datos = [
                'usuario' => $sesion->get('usuario'),
                'tareas' => $tareas,
                'subtareas' => $subtareas,
                'colores' => $colores,
                'coloresSubtareas' => $coloressubtareas,
                'prioridades' => $prioridades
            ];

            return view('Archivadas',$datos);
        }else{
            //Si el usuario no esta logeado
            return redirect()->to('login');
        }
    }
}
?>