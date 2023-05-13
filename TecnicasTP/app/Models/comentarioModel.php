<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class comentarioModel extends Model
    {
        protected $table      = 'comentarios';
        protected $primaryKey = 'codigo';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';

        protected $allowedFields = ['Comentario','CodigoUsuario','CodigoSubtarea'];

        public function buscoPorSubtarea($codigoS){
            //Traigo las tareas de la BD
            $bd = \Config\Database::connect();
            $tablaComentarios = $bd->table('comentarios c');

            //Realizo el inner join de las tablas prioridades, estados y colores
            $tablaComentarios->select('c.Codigo,c.Comentario,u.Nombre,u.Apellido');
            $tablaComentarios->join('usuarios u', 'u.Codigo = c.CodigoUsuario');
            $tablaComentarios->where('c.CodigoSubtarea', $codigoS);
            $comentarios = $tablaComentarios->get()->getResultArray();

            return $comentarios;
        }
    }
?>