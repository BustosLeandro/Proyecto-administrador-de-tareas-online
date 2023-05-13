<?php

namespace App\Controllers;

use App\Models\usuarioModel;

class Registrarse extends BaseController
{
    public function __construct(){
        helper('form');
    }

    public function index()
    {
        return view('registrarse');
    }

    public function enviado(){
        $usuario = new usuarioModel();
        //Defino las reglas de validacion
        $validation = service('validation');
        $validation->setRules([
            'Nombre' => 'required|min_length[3]|max_length[20]|alpha',
            'Apellido' => 'required|min_length[3]|max_length[20]|alpha',
            'Email' => 'required|valid_email|is_unique[usuarios.email]',
            'Password'=>'required|min_length[8]|matches[c-password]',
            'c-password'=> 'required'
        ],
        [
            'Nombre' => [
                'required' => 'Debe ingresar su nombre',
                'min_length' => 'El nombre debe tener al menos 3 caracteres',
                'max_length' => 'El nombre no debe tener más de 20 caracteres',
                'alpha' => 'El nombre solo puede contener letras'
            ],
            'Apellido' => [
                'required' => 'Debe ingresar su apellido',
                'min_length' => 'El apellido debe tener al menos 3 caracteres',
                'max_length' => 'El apellido no debe tener más de 20 caracteres',
                'alpha' => 'El apellido solo puede contener letras'
            ],
            'Email' => [
                'required' => 'Debe ingresar un email',
                'valid_email' => 'El formato de email es invalido',
                'is_unique' => 'Este correo electrónico ya tiene una cuenta asociada'
            ],
            'Password' => [
                'required' => 'Debe ingresar una contraseña',
                'min_length' => 'La contraseña debe tener al menos 8 caracteres',
                'matches'=>'Error al confirmar contraseña'
            ],
            'c-password' => [
                'required' => 'Debe confirmar su contraseña'
            ]
        ]);

        //Si los campos son invalidos devuelvo los mismos al formulario
        if (!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }

        $data=array(
            'Nombre'=>$this->request->getPost('Nombre'),
            'Apellido'=>$this->request->getPost('Apellido'),
            'Email'=>$this->request->getPost('Email'),

            //Encriptado de la contraseña
            'Password'=>password_hash($this->request->getPost('Password'), PASSWORD_DEFAULT,['cost' => 10])            
        );

        //Si los campos son validos creo abro la sesión y redirecciono al inicio
        $usuario->insert($data);

        $sesion = session();
        $sesion->set('usuario',$usuario->getInsertID());

        return redirect()->to('');
    }

    public function cambiarPassword($codigoUsuario){
        //Defino las reglas de validacion
        $validation = service('validation');
        $validation->setRules([
            'pAnterior' => 'required|min_length[8]',
            'pNueva' => 'required|min_length[8]|matches[pConfirmar]',
            'pConfirmar' => 'required'
        ],
        [
            'pAnterior' => [
                'required' => 'El campo contraseña anterior es requerido',
                'min_length[8]' => 'La contraseña anterior debe tener al menos 8 caracteres'
            ],
            'pNueva' => [
                'required' => 'El campo nueva contraseña es requerido',
                'min_length' => 'La nueva contraseña debe tener al menos 8 caracteres',
                'matches'=>'Error al confirmar contraseña'
            ],
            'pConfirmar' => [
                'required' => 'Debe confirmar su contraseña'
            ]
        ]);

        //Si los campos no son validos devuelvo los mismos al formulario
        if (!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }

        $pAnterior = $this->request->getPost('pAnterior');

        $usuarioModel = new usuarioModel();
        $usuario = $user = $usuarioModel->select('Password')->find($codigoUsuario);

        if(password_verify($pAnterior, $usuario['Password'])){
            
            $data = [
            //Encriptado de la contraseña
             'Password' => password_hash($this->request->getPost('pNueva'), PASSWORD_DEFAULT,['cost' => 10])
            ];

            $usuarioModel->update($codigoUsuario, $data);
            echo "<script>alert('Cambio de contraseña realizado');window.location.href = \"".base_url()."\"</script>";
        }else{
            echo "<script>alert('La contraseña anterior es incorrecta');window.location.href = \"".base_url()."\"</script>";
        }
    }
}