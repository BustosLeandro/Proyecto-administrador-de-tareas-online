<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class tareaModel extends Model
    {
        protected $table      = 'tareas';
        protected $primaryKey = 'codigo';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';

        protected $allowedFields = ['Titulo', 'Descripcion', 'FechaVencimiento', 'FechaRecordatorio', 'CodigoUsuario', 'CodigoColor', 'CodigoEstado', 'CodigoPrioridad', 'estaArchivada'];

        public function traerTareas(){
            //Traigo las tareas de la BD
            $bd = \Config\Database::connect();
            $tablaTareas = $bd->table('tareas t');

            //Realizo el inner join de las tablas prioridades, estados y colores
            $tablaTareas->select('t.*, p.Prioridad, p.Codigo as CodigoP , e.Estado');
            $tablaTareas->join('prioridades p', 'p.Codigo = t.CodigoPrioridad');
            $tablaTareas->join('estados e', 'e.Codigo = t.CodigoEstado');
            $tablaTareas->where('t.estaArchivada', 0);
            $tareas = $tablaTareas->get()->getResultArray();

            return $tareas;
        }

        public function getOrdenadasPorPrioridad(){
            //Traigo las tareas de la BD
            $bd = \Config\Database::connect();
            $tablaTareas = $bd->table('tareas t');

            //Realizo el inner join de las tablas prioridades, estados y colores
            $tablaTareas->select('t.*, p.Prioridad, p.Codigo as CodigoP , e.Estado');
            $tablaTareas->join('prioridades p', 'p.Codigo = t.CodigoPrioridad');
            $tablaTareas->join('estados e', 'e.Codigo = t.CodigoEstado');
            $tablaTareas->orderBy('p.Codigo', 'DESC');
            $tablaTareas->where('t.estaArchivada', 0);
            $tareas = $tablaTareas->get()->getResultArray();

            return $tareas;
        }

        public function getOrdenadasPorFechaVencimiento(){
            //Traigo las tareas de la BD
            $bd = \Config\Database::connect();
            $tablaTareas = $bd->table('tareas t');

            //Realizo el inner join de las tablas prioridades, estados y colores
            $tablaTareas->select('t.*, p.Prioridad, p.Codigo as CodigoP , e.Estado');
            $tablaTareas->join('prioridades p', 'p.Codigo = t.CodigoPrioridad');
            $tablaTareas->join('estados e', 'e.Codigo = t.CodigoEstado');
            $tablaTareas->orderBy('t.FechaVencimiento', 'ASC');
            $tablaTareas->where('t.estaArchivada', 0);
            $tareas = $tablaTareas->get()->getResultArray();

            return $tareas;
        }

        public function getOrdenadasPorAntiguedad(){
            //Traigo las tareas de la BD
            $bd = \Config\Database::connect();
            $tablaTareas = $bd->table('tareas t');

            //Realizo el inner join de las tablas prioridades, estados y colores
            $tablaTareas->select('t.*, p.Prioridad, p.Codigo as CodigoP , e.Estado');
            $tablaTareas->join('prioridades p', 'p.Codigo = t.CodigoPrioridad');
            $tablaTareas->join('estados e', 'e.Codigo = t.CodigoEstado');
            $tablaTareas->orderBy('t.FechaCreacion', 'ASC');
            $tablaTareas->where('t.estaArchivada', 0);
            $tareas = $tablaTareas->get()->getResultArray();

            return $tareas;
        }

        public function getOrdenadasPorReciente(){
            //Traigo las tareas de la BD
            $bd = \Config\Database::connect();
            $tablaTareas = $bd->table('tareas t');

            //Realizo el inner join de las tablas prioridades, estados y colores
            $tablaTareas->select('t.*, p.Prioridad, p.Codigo as CodigoP , e.Estado');
            $tablaTareas->join('prioridades p', 'p.Codigo = t.CodigoPrioridad');
            $tablaTareas->join('estados e', 'e.Codigo = t.CodigoEstado');
            $tablaTareas->orderBy('t.FechaCreacion', 'DESC');
            $tablaTareas->where('t.estaArchivada', 0);
            $tareas = $tablaTareas->get()->getResultArray();

            return $tareas;
        }

        public function traerArchivadas(){
            //Traigo las tareas de la BD
            $bd = \Config\Database::connect();
            $tablaTareas = $bd->table('tareas t');

            //Realizo el inner join de las tablas prioridades, estados y colores
            $tablaTareas->select('t.*, p.Prioridad, p.Codigo as CodigoP , e.Estado');
            $tablaTareas->join('prioridades p', 'p.Codigo = t.CodigoPrioridad');
            $tablaTareas->join('estados e', 'e.Codigo = t.CodigoEstado');
            $tablaTareas->where('t.estaArchivada', 1);
            $tareas = $tablaTareas->get()->getResultArray();

            return $tareas;
        }

        public function traerTarea($codigo){
            //Conexión con la base de datos
            $bd = \Config\Database::connect();
            $tabla = $bd->table('tareas t');

            //Variables para realizar el inner join
            $tabla->select('t.*, e.Estado, u.Nombre, p.Prioridad');
            $tabla->join('estados e', 't.CodigoEstado = e.Codigo');
            $tabla->join('usuarios u', 't.CodigoUsuario = u.Codigo');
            $tabla->join('prioridades p', 't.CodigoPrioridad = p.Codigo');
            $tabla->where('t.Codigo', $codigo);
            $tarea = $tabla->get()->getResultArray();
            $tarea = $tarea[0];

            return $tarea;
        }

        //Pasandole el codigo de la subtarea devuelvo el estado de su tarea madre
        public function devolverEstado($codigoSubtarea){
            //Conexión con la base de datos
            $bd = \Config\Database::connect();
            $tabla = $bd->table('tareas t');

            $tabla->select('t.Codigo,e.Estado');
            $tabla->join('estados e', 't.CodigoEstado = e.Codigo');
            $tabla->join('subtareas s', 's.CodigoTarea = t.Codigo');
            $tabla->where('s.Codigo', $codigoSubtarea);
            $estado = $tabla->get()->getResultArray();
            $estado = $estado[0];

            return $estado;
        }
    }
?>