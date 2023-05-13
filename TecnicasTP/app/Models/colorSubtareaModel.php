<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class colorSubtareaModel extends Model
    {
        protected $table      = 'coloressubtareas';
        protected $primaryKey = 'codigo';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';

        protected $allowedFields = ['Color'];

        //Esta función evita el tener que acceder a los colores asi: $colores[0][Codigo]
        public function traerColoresSubtareasOrdenadosCodigo(){
            $colores = new colorModel();
            $colores = $colores->findAll();
            $arregloColores = [];

            foreach($colores as $color){
                $arregloColores[$color['Codigo']] = $color['Valor'];
            }

            return $arregloColores;
        }

        public function traerColoresSubtareasOrdenadosColor(){
            $colores = new colorModel();
            $colores = $colores->findAll();
            $arregloColores = [];

            foreach($colores as $color){
                $arregloColores[$color['Color']] = $color['Valor'];
            }

            return $arregloColores;
        }

        //A esta funcion se le pasa un color en formato "text-bg-... y devuelve su codigo"
        public function devolverCodigo($nombreColor){
            $color = new colorModel();
            $codigoColor = $color->where('Valor',$nombreColor)->find();
            
            return $codigoColor;
        }
    }
?>