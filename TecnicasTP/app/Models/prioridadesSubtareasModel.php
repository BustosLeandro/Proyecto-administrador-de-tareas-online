<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class prioridadesSubtareasModel extends Model
    {
        protected $table      = 'prioridadessubtareas';
        protected $primaryKey = 'Codigo';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';

        protected $allowedFields = ['Prioridad'];

        public function traerPrioridadesOrdenadas(){
            $prioridades = new prioridadesSubtareasModel();
            $prioridades = $prioridades->findAll();
            $arregloPrioridades = [];

            foreach($prioridades as $prioridad){
                $arregloPrioridades[$prioridad['Codigo']] = $prioridad['Prioridad'];
            }

            return $arregloPrioridades;
        }

        public function devolverCodigo($nombrePrioridad){
            $prioridad = new prioridadModel();
            $codigoPrioridad = $prioridad->where('Prioridad',$nombrePrioridad)->find();
            
            return $codigoPrioridad;
        }
    }
?>