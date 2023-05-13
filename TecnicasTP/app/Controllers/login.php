<?php

namespace App\Controllers;

use App\Models\usuarioModel;

class Login extends BaseController
{
    public function __construct(){
        helper('form');
    }

    public function index()
    {
        return view('login');
    }

    public function enviado(){
        $usuario = new usuarioModel();
        //Obtengo el contenido de los inputs
        $data=array(
            'email'=>$this->request-> getPost('email'),
            'password'=>$this->request->getPost('password')
        );

        //Defino las reglas de validacion
        $validation = service('validation');
        $validation->setRules([
            'email' => 'required|valid_email',
            'password'=>'required|min_length[8]'],
        [
            'email' => [
                'required' => 'Debe ingresar un email',
                'valid_email' => 'El formato de email es invalido'
            ],
            'password' => [
                'required' => 'Debe ingresar una contraseña',
                'min_length' => 'La contraseña debe tener al menos 8 caracteres'
            ]
        ]);

        //Si los campos no son validos devuelvo los mismos al formulario
        if (!$validation->withRequest($this->request)->run()){
            return redirect()->back()->withInput()->with('errors',$validation->getErrors());
        }

        //Si los campos son validos creo abro la sesión y redirecciono al inicio
        $usuario = $usuario->where('Email', $data['email'])->findAll();

        if($usuario == null){
           //CREAR Y DEVOLVER MENSAJE DE CONTRASEÑA O EMAIL INCORRECTOS
        }else{
            if(password_verify($data['password'], $usuario[0]['Password'])){
                $sesion = session();
                $sesion->set('usuario',$usuario[0]['Codigo']);
                return redirect()->to('');
            }else{
                echo "<script>alert('La contraseña o el email son incorrectos');window.location.href = \"".base_url()."/login\"</script>";
            } 
        }
    }
}
