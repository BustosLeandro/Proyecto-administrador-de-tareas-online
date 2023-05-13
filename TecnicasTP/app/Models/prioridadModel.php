<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class prioridadModel extends Model
    {
        protected $table      = 'prioridades';
        protected $primaryKey = 'Codigo';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';

        protected $allowedFields = ['Prioridad'];

        public function traerPrioridadesOrdenadas(){
            $prioridades = new prioridadModel();
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