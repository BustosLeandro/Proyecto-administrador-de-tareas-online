<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class usuarioModel extends Model
    {
        protected $table      = 'usuarios';
        protected $primaryKey = 'codigo';

        protected $useAutoIncrement = true;

        protected $returnType     = 'array';

        protected $allowedFields = ['Nombre', 'Apellido', 'Password', 'Email', 'FotoPerfil', 'FotoIcono'];
    }
?>