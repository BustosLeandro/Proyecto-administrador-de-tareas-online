<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class subtareaModel extends Model
    {
        protected $table      = 'subtareas';
        protected $primaryKey = 'codigo';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';

        protected $allowedFields = ['Titulo','CodigoUsuario','CodigoTarea','Descripcion','CodigoEstado','CodigoPrioridad','CodigoColor','FechaVencimiento','FechaCreacion','FechaAsignacion', 'estaArchivada'];

        public function traerSubtareas(){
            $bd = \Config\Database::connect();
            $tablaSTareas = $bd->table('subtareas s');

            //Realizo el inner join de las tablas prioridadesSubtareas, estadosSubtareas y coloresSubtareas
            $tablaSTareas->select('s.*, e.Estado');
            $tablaSTareas->join('estadossubtareas e', 'e.Codigo = s.CodigoEstado');
            $tablaSTareas->orderBy('s.CodigoPrioridad', 'DESC');
            $tablaSTareas->where('s.estaArchivada', 0);
            $subtareas = $tablaSTareas->get()->getResultArray();

            return $subtareas;
        }

        public function traerArchivadas(){
            $bd = \Config\Database::connect();
            $tablaSTareas = $bd->table('subtareas s');

            //Realizo el inner join de las tablas prioridadesSubtareas, estadosSubtareas y coloresSubtareas
            $tablaSTareas->select('s.*, e.Estado');
            $tablaSTareas->join('estadossubtareas e', 'e.Codigo = s.CodigoEstado');
            $tablaSTareas->orderBy('s.CodigoPrioridad', 'DESC');
            $tablaSTareas->where('s.estaArchivada', 1);
            $subtareas = $tablaSTareas->get()->getResultArray();

            return $subtareas;
        }

        public function traerSubtarea($codigo){
            //Conexión con la base de datos
            $bd = \Config\Database::connect();
            $tabla = $bd->table('subtareas s');

            //Variables para realizar el inner join
            $tabla->select('s.*,t.Titulo as TituloT,t.Codigo as CodigoT,e.Estado');
            $tabla->where('s.Codigo', $codigo);
            $tabla->join('tareas t','t.Codigo = s.CodigoTarea');
            $tabla->join('estados e','e.Codigo = s.CodigoEstado');
            $tarea = $tabla->get()->getResultArray();
            $tarea = $tarea[0];

            return $tarea;
        }

        //Pasando el codigo de la tarea devuelvo el codigo de sus subtareas
        public function getCodigos($codigoTarea){
            $subtareaModel = new subtareaModel();
            $codigosSubtareas = $subtareaModel->select('Codigo')->where('CodigoTarea', $codigoTarea)->findAll();

            return $codigosSubtareas;
        }
    }
?>