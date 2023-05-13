<?php

namespace App\Controllers;

use App\Models\tareaModel;
use App\Models\subtareaModel;
use App\Models\colorModel;
use App\Models\colorSubtareaModel;
use App\Models\prioridadesSubtareasModel;

class Home extends BaseController
{

    public function index()
    {

        $sesion = session();
        //Si el usuario ya esta logeado
        if($sesion->has('usuario')){

            $tareas = new tareaModel();
            $subtareas = new subtareaModel();

            $tareas = $tareas->traerTareas();
            $subtareas = $subtareas->traerSubtareas();

            //Necesarios por campos nulos
            $colores = new colorModel();
            $colores = $colores->traerColoresOrdenadosCodigo();

            $coloressubtareas = new colorSubtareaModel();
            $coloressubtareas = $coloressubtareas->traerColoresSubtareasOrdenadosCodigo();

            $prioridades = new prioridadesSubtareasModel();
            $prioridades = $prioridades->traerPrioridadesOrdenadas();

            $datos = [
                'usuario' => $sesion->get('usuario'),
                'tareas' => $tareas,
                'subtareas' => $subtareas,
                'colores' => $colores,
                'coloresSubtareas' => $coloressubtareas,
                'prioridades' => $prioridades
            ];

            echo view('Home', $datos);
            echo view('layouts/footer');

        }else{
            
            //Si el usuario no esta logeado
            return redirect()->to('login');

        }
    }

    public function cerrarSesion(){
        $sesion = session();
        $sesion->destroy();
        return redirect()->to('login');
    }
}
