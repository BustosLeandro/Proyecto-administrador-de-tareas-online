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
            
            if($this->request->getGet('ordenar')){
                $orden = $this->request->getGet('ordenar');
            }else{
                //Si no esta seteado al get entraria al caso default en el switch (funcion traer tareas)
                $orden = 0;
            }
            
            $tareas = $this->traerTareas($orden);

            $subtareas = new subtareaModel();
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

    public function traerTareas($orden){
        $tareaModel = new tareaModel();
        switch($orden){
            case 1:
                $tareas = $tareaModel->getOrdenadasPorPrioridad();
                break;
            case 2:
                $tareas = $tareaModel->getOrdenadasPorFechaVencimiento();
                break;
            case 3:
                $tareas = $tareaModel->getOrdenadasPorAntiguedad();
                break;
            case 4:
                $tareas = $tareaModel->getOrdenadasPorReciente();
                break;
            default:
                //Ingresa aqui si no esta seteado el get o si el usuario cambia el valor del get a uno invalido
                $tareas = $tareaModel->traerTareas(); //(Ordena por el Codigo de la tarea)
        }
        return $tareas;
    }
}
