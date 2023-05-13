<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class estadoModel extends Model
    {
        protected $table      = 'estados';
        protected $primaryKey = 'Codigo';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';

        protected $allowedFields = ['Estado'];

        public function devolverCodigo($nombreEstado){
            $estado = new estadoModel();
            $codigoEstado = $estado->where('Estado',$nombreEstado)->find();
            
            return $codigoEstado;
        }

        public function traerEstadosOrdenados(){
            $estados = new estadoModel();
            $estados = $estados->findAll();
            $arregloEstados = [];

            foreach($estados as $estado){
                $arregloEstados[$estado['Codigo']] = $estado['Estado'];
            }

            return $arregloEstados;
        }
    }
?>