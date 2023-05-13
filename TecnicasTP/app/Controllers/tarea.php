<?php

namespace App\Controllers;

use App\Models\tareaModel;
use App\Models\colorModel;
use App\Models\estadoModel;
use App\Models\prioridadModel;

class Tarea extends BaseController
{
    public function __construct(){
        $session = session();
        helper('form');
    }

    public function index($codigo)
    {
        $sesion = session();
        if(!($sesion->has('usuario'))){
            return redirect()->to('login');
        }
        $tarea = new tareaModel();
        $color = new colorModel();
        $tarea = $tarea->traerTarea($codigo);

        //Si la tarea tenía color creo la variable Color y le asigno la que coincida con la clave CodigoColor
        if($tarea['CodigoColor'] != null){
            $colores = $color->traerColoresOrdenadosCodigo();
            $tarea['Color'] = $colores[$tarea['CodigoColor']];
        }else{
            $tarea['Color'] = "";
        }

        $datos = [
            'tarea' => $tarea 
        ];

        echo view('tarea',$datos);
        echo view('layouts/footer');
    }

    public function formColor($codigo){
        $selColor = $this->request->getPost('selColor');
        if ( $selColor!==null){
            $color = new colorModel();
            $tarea = new tareaModel();

            if($selColor == ""){
                $data = [
                    'CodigoColor' => NULL
                ];
            }else{
                $codigoColor = $color->devolverCodigo($selColor);
                $data = [
                  'CodigoColor' => $codigoColor[0]['Codigo']
                ];
            }

            $tarea->update($codigo, $data);
            return redirect()->to('tarea/'.$codigo);
        } else {
            return redirect()->to('tarea/'.$codigo);
        }
    }

    public function formEstado($codigoTarea){
        $selEstado = $this->request->getPost('selEstado');
        if ($selEstado !== null){
            $estado = new estadoModel();
            $tarea = new tareaModel();

            //Le paso el estado y me devuelve el codigo de ese estado
            $CodigoEstado = $estado->devolverCodigo($selEstado);

            $data = [
                'CodigoEstado' => $CodigoEstado[0]['Codigo']
            ];

            $tarea->update($codigoTarea,$data);
            return redirect()->to('tarea/'.$codigoTarea);
        }else{
            return redirect()->to('tarea/'.$codigoTarea);
        }
    }

    public function formPrioridad($codigoTarea){
        $selPrioridad = $this->request->getPost('selPrioridad');
        $prioridad = new prioridadModel();
        $tarea = new tareaModel();

        $codigoPrioridad = $prioridad->devolverCodigo($selPrioridad);

        $data = [
            'CodigoPrioridad' => $codigoPrioridad[0]['Codigo']
        ];

        $tarea->update($codigoTarea,$data);
        return redirect()->to('tarea/'.$codigoTarea);
    }

    public function crearTarea(){
        $sesion = session();
        if(!($sesion->has('usuario'))){
            return redirect()->to('login');
        }

        $prioridadModel = new prioridadModel();
        $colorModel = new colorModel();

        $datos = [
            'prioridades' => $prioridadModel->traerPrioridadesOrdenadas(),
            'colores' => $colorModel->traerColoresOrdenadosColor()
        ];
        
        return view('crearTarea',$datos);
    }

    public function formTarea(){
        $session = session();
        $tareaModel = new tareaModel();
        $validation = service('validation');
        $validation->setRules([
            'tituloTarea' => 'required|min_length[10]|max_length[30]|alpha_numeric_space',
            'prioridadTarea' => 'required',
            'descripcionTarea'=> 'required|min_length[10]|max_length[500]|alpha_numeric_space',
            'FechaVencimientoTarea' => 'required',
        ],
        [
            'tituloTarea'=>[
                'required'=>'El campo título es obligatorio',
                'min_length'=>'La longitud minima del campo título es de 10',
                'max_length'=>'La longitud máxima del campo título es de 30',
                'alpha_numeric_space'=>'El campo título solo puede tener caracteres alfanuméricos y el espacio'
            ],
            'prioridadTarea'=>[
                'required'=>'El campo prioridad es obligatorio'
            ],
            'descripcionTarea'=>[
                'required'=>'El campo descrición es obligatorio',
                'min_length'=>'La longitud minima del campo descrición es de 10',
                'max_length'=>'La longitud máxima del campo descrición es de 500',
                'alpha_numeric_space'=>'El campo descrición solo puede tener caracteres alfanuméricos y el espacio'
            ],
            'FechaVencimientoTarea'=>[
                'required' => 'El campo fecha de vencimiento es obligatorio'
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }

        $data=array(
            'CodigoUsuario'=> $session->get('usuario'),
            'Titulo'=>$this->request->getPost('tituloTarea'),
            'Prioridad'=>$this->request->getPost('prioridadTarea'),
            'Descripcion'=>$this->request->getPost('descripcionTarea'),
            'FechaVencimiento'=>$this->request->getPost('FechaVencimientoTarea'),
        );

        if($this->request->getPost('colorTarea')){
            $data['Color'] = $this->request->getPost('colorTarea');
        }

        if($this->request->getPost('FechaRecordatorioTarea')){
            $data['FechaRecordatorio'] = $this->request->getPost('FechaRecordatorioTarea');
        }
        $this->guardarTarea($data);
        return redirect()->to('');
    }

    public function guardarTarea($data){    
        $tareaModel = new tareaModel();

        //Creo la subtarea con el estado DEFINIDA
        $estadoModel = new estadoModel();
        $codigoEstado = $estadoModel->where('Estado','Definida')->find();        
        $data['CodigoEstado'] = $codigoEstado[0]['Codigo'];

        $prioridadModel = new prioridadModel();
        $codigoPrioridad = $prioridadModel->where('Prioridad',$data['Prioridad'])->find();
        $data['CodigoPrioridad'] = $codigoPrioridad[0]['Codigo'];

        if(isset($data['Color'])){
            $colorModel = new colorModel();
            $codigoColor = $colorModel->where('Color',$data['Color'])->find();
            $data['CodigoColor'] = $codigoColor[0]['Codigo'];
        }

        $tareaModel->insert($data);
    }

    public function borrarTarea($codigo){
        $sesion = session();
        if(!($sesion->has('usuario'))){
            return redirect()->to('login');
        }

        $tareaModel = new tareaModel();
        $tareaModel->delete($codigo);

        return redirect()->to('');
    }
}
