<?php

namespace App\Controllers;

use App\Models\comentarioModel;

class Comentario extends BaseController
{
	public function borrarComentario($codigoComentario,$codigoSubtarea){
        $comentario = new comentarioModel();
        $comentario->where('codigoSubtarea', $codigoSubtarea)->where('Codigo',$codigoComentario)->delete();

        return redirect()->to('subtarea/'.$codigoSubtarea);
    }
}

?>