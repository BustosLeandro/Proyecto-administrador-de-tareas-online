<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class estadoSubtareaModel extends Model
    {
        protected $table      = 'estadossubtareas';
        protected $primaryKey = 'Codigo';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';

        protected $allowedFields = ['Estado'];

        public function devolverCodigo($nombreEstado){
            $estado = new estadoModel();
            $codigoEstado = $estado->where('Estado',$nombreEstado)->find();
            
            return $codigoEstado;
        }
    }
?>