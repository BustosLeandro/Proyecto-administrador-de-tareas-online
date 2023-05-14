<?php

namespace App\Controllers;

use App\Models\subtareaModel;
use App\Models\colorSubtareaModel;
use App\Models\estadoSubtareaModel;
use App\Models\prioridadesSubtareasModel;
use App\Models\comentarioModel;
use App\Models\usuarioModel;

class Subtarea extends BaseController
{
    public function __construct(){
        helper('form');
        $sesion = session();
    }

    public function index($codigo)
    {
        $sesion = session();
        if(!($sesion->has('usuario'))){
            return redirect()->to('login');
        }
        $usuario = new usuarioModel();
        $comentarios = new comentarioModel();
        $prioridad = new prioridadesSubtareasModel();
        $color = new colorSubtareaModel();
        $subtarea = new subtareaModel();
        $subtarea = $subtarea->traerSubtarea($codigo);
        
        //Si la subtarea tenía color creo la variable Color y le asigno la que coincida con la clave CodigoColor
        if($subtarea['CodigoColor'] != null){
            $colores = $color->traerColoresSubtareasOrdenadosCodigo();
            $subtarea['Color'] = $colores[$subtarea['CodigoColor']];
        }else{
            $subtarea['Color'] = "";
        }

        //Si la subtarea tenia una prioridad creo la variable prioridad y le asigno la que coincida con la clave CodigoPrioridad
        if($subtarea['CodigoPrioridad'] != null){
            $prioridades = $prioridad->traerPrioridadesOrdenadas();
            $subtarea['Prioridad'] = $prioridades[$subtarea['CodigoPrioridad']];
        }else{
            $subtarea['Prioridad'] = "-";
        }

        //Si la subtarea tiene colaborador creo la variable NombreResponsable y le asigno la que coincida con la clave CodigoColaborador
        if($subtarea['CodigoColaborador'] != null){
            $colaborador = $usuario->find($subtarea['CodigoColaborador']);
            $subtarea['NombreResponsable'] = $colaborador['Nombre'];
        }else{
            $subtarea['NombreResponsable'] = " N/A ";
        }

        //Traigo los comentarios de la subtarea
        $comentarios = $comentarios->buscoPorSubtarea($codigo);

        $datos = [
            'usuario' => $sesion->get('usuario'),
            'usuarios' => $usuario->findAll(),
            'subtarea' => $subtarea,
            'comentarios' => $comentarios
        ];

        return view('subtarea',$datos);

    }

    public function formColor($codigo){
        $selColor = $this->request->getPost('selColor');
        if ($selColor!==null){
            $subtarea = new subtareaModel();
            $color = new colorSubtareaModel();

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

            $subtarea->update($codigo, $data);
            return redirect()->to('subtarea/'.$codigo);

        }else{
            return redirect()->to('subtarea/'.$codigo);
        }
    }

    public function formEstado($codigo){
        $selEstado = $this->request->getPost('selEstado');
        if ($selEstado !== null){
            $estado = new estadoSubtareaModel();
            $subtarea = new subtareaModel();

            //Le paso el estado y me devuelve el codigo de ese estado
            $CodigoEstado = $estado->devolverCodigo($selEstado);

            $data = [
                'CodigoEstado' => $CodigoEstado[0]['Codigo']
            ];

            $subtarea->update($codigo,$data);
            return redirect()->to('subtarea/'.$codigo);
        }else{
            return redirect()->to('subtarea/'.$codigo);
        }
    }

    public function formPrioridad($codigoSubtarea){
        $selPrioridad = $this->request->getPost('selPrioridad');
        $prioridad = new prioridadesSubtareasModel();
        $subtarea = new subtareaModel();

        $codigoPrioridad = $prioridad->devolverCodigo($selPrioridad);

        $data = [
            'CodigoPrioridad' => $codigoPrioridad[0]['Codigo']
        ];

        $subtarea->update($codigoSubtarea,$data);
        return redirect()->to('subtarea/'.$codigoSubtarea);
    }

    public function crearSubtarea($codigoTarea){

        $sesion = session();
        if(!($sesion->has('usuario'))){
            return redirect()->to('login');
        }

        $prioridadSubtareaModel = new prioridadesSubtareasModel();
        $colorSubtareaModel = new colorSubtareaModel();

        $datos = [
            'usuario' => $sesion->get('usuario'),
            'prioridades' => $prioridadSubtareaModel->traerPrioridadesOrdenadas(),
            'colores' => $colorSubtareaModel->traerColoresSubtareasOrdenadosColor(),
            'codigoTarea' => $codigoTarea
        ];

        return view('crearSubtarea',$datos);
    }

    public function formSubtarea($codigoTarea){
        $session = session();
        $subtareaModel = new subtareaModel();
        $validation = service('validation');
        $validation->setRules([
            'tituloSubtarea' => 'required|min_length[10]|max_length[30]|alpha_numeric_space',            
            'descripcionSubtarea'=> 'required|min_length[10]|max_length[500]|alpha_numeric_space',
        ],[
            'tituloSubtarea'=>[
                'required'=>'El campo título es obligatorio',
                'min_length'=>'La longitud minima del campo título es de 10',
                'max_length'=>'La longitud máxima del campo título es de 30',
                'alpha_numeric_space'=>'El campo título solo puede tener caracteres alfanuméricos y el espacio'
            ],
            'descripcionSubtarea'=>[
                'required'=>'El campo descrición es obligatorio',
                'min_length'=>'La longitud minima del campo descrición es de 10',
                'max_length'=>'La longitud máxima del campo descrición es de 500',
                'alpha_numeric_space'=>'El campo descrición solo puede tener caracteres alfanuméricos y el espacio'
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }

        $data=array(
            'CodigoUsuario'=> $session->get('usuario'),
            'CodigoTarea' => $codigoTarea,
            'Titulo'=>$this->request->getPost('tituloSubtarea'),
            'Descripcion'=>$this->request->getPost('descripcionSubtarea'),
        );

        if($this->request->getPost('prioridadSubtarea')){
            $data['Prioridad'] = $this->request->getPost('prioridadSubtarea');
        }

        if($this->request->getPost('FechaVencimientoSubtarea')){
            $data['FechaVencimiento'] = $this->request->getPost('FechaVencimientoSubtarea');
        }

        if($this->request->getPost('colorSubtarea')){
            $data['Color'] = $this->request->getPost('colorSubtarea');
        }

        if($this->request->getPost('FechaRecordatorioSubtarea')){
            $data['FechaRecordatorio'] = $this->request->getPost('FechaRecordatorioSubtarea');
        }

        $this->guardarSubtarea($data);
        return redirect()->to('');
    }

    public function guardarSubtarea($data){    
        $subtareaModel = new subtareaModel();
        
        //Creo la subtarea con el estado DEFINIDA
        $estadoModel = new estadoSubtareaModel();        
        $codigoEstado = $estadoModel->where('Estado','Definida')->find();        
        $data['CodigoEstado'] = $codigoEstado[0]['Codigo'];

        if(isset($data['Color'])){
            $colorModel = new colorSubtareaModel();
            $codigoColor = $colorModel->where('Valor',$data['Color'])->find();
            $data['CodigoColor'] = $codigoColor[0]['Codigo'];
        }

        if(isset($data['Prioridad'])){
            $prioridadModel = new prioridadesSubtareasModel();
            $codigoPrioridad = $prioridadModel->where('Prioridad',$data['Prioridad'])->find();
            $data['CodigoPrioridad'] = $codigoPrioridad[0]['Codigo'];
        }

        $subtareaModel->insert($data);
    }

    public function borrarSubtarea($codigo){
        $sesion = session();
        if(!($sesion->has('usuario'))){
            return redirect()->to('login');
        }

        $subtareaModel = new subtareaModel();
        $subtareaModel->delete($codigo);

        return redirect()->to('');
    }

    public function formResponsable($codigoSubtarea){
        $subtareaModel = new subtareaModel();
        $validation = service('validation');
        $validation->setRules([
            'responsable' => 'required',
        ],[
            'responsable'=>[
                'required'=>'Debe seleccionar un responsable'
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }
    }
}
