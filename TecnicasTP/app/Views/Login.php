<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GT - Iniciar sesión</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>estilos/estilos.css">
        <script src="<?= base_url() ?>js/formulario.js" defer></script>
    </head>
    <body style="background-image: url(<?= base_url() ?>imagenes/Fondo-form.jpg)" class="fondo-form">
        <!-- Boton (Activa automaticamente la ventana modal al cargar la página) -->
        <button type="button" class="boton-invisible" data-bs-toggle="modal" data-bs-target="#modalIniciarSesion" id="boton"></button>

        <!-- Formulario de inicio de sesión -->
        <div class="modal fade" id="modalIniciarSesion" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"  aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <img src="<?= base_url()?>imagenes/Logo-GT.png" class="logo mx-auto d-block">
                    </div>
                    <div class="modal-body">
                        <?php
                        
                        echo form_open('login/enviado');
                        //Etiqueta e input para email
                        echo "<div class=\"mb-3\"><label for=\"email\" class=\"form-label\">Correo electrónico</label>";
                        echo form_input(array('id'=>'email','name'=>'email','type'=>'email','placeholder'=>'Ingrese su correo electrónico...','class' => 'form-control','value'=>old('email')));
                        echo "<label class=\"form-label text-danger\">".session('errors.email')."<label>";

                        //Etiqueta e input para contraseña
                        echo "</div><div class=\"mb-3\"><label for=\"password\" class=\"form-label\">Contraseña</label>";
                        echo form_password(array('id'=>'password','name'=>'password','class'=>'form-control','placeholder'=>'Ingrese su contraseña...'));
                        echo "<label class=\"form-label text-danger\">".session('errors.password')."<label>";
                        echo "</div>";

                        //Botón de enviar
                        echo form_input(array('id'=>'enviar','name'=>'enviar','value'=>'Enviar','type'=>'submit','class'=>'btn btn-primary mx-auto d-block'));
                        echo form_close();
                        ?>
                    </div>
                    <hr>                    
                    <a href="<?= base_url() ?>registrarse" class="btn btn-success mx-auto d-block">Registrarse</a><br>
                    <a href="#" class="mb-3 ms-3">¿Olvidaste tu contraseña?</a>                    
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
</html>