<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GT - Registrarse</title>
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
                        echo form_open('registrarse/enviado');
                        //Etiqueta e input para nombre
                        echo "<div class=\"mb-1\"><label for=\"nombre\" class=\"form-label\">Nombre</label>";
                        echo form_input(array('id'=>'nombre','name'=>'Nombre','placeholder'=>'Ingrese su nombre...','class' => 'form-control','value'=>old('nombre')));
                        echo "<label class=\"form-label text-danger\">".session('errors.nombre')."<label></div>";

                        //Etiqueta e input para apellido
                        echo "<div class=\"mb-1\"><label for=\"apellido\" class=\"form-label\">Apellido</label>";
                        echo form_input(array('id'=>'apellido','name'=>'Apellido','placeholder'=>'Ingrese su apellido...','class' => 'form-control','value'=>old('apellido')));
                        echo "<label class=\"form-label text-danger\">".session('errors.apellido')."<label></div>";

                        //Etiqueta e input para email
                        echo "<div class=\"mb-1\"><label for=\"email\" class=\"form-label\">Correo electrónico</label>";
                        echo form_input(array('id'=>'email','name'=>'Email','type'=>'email','placeholder'=>'Ingrese su correo electrónico...','class' => 'form-control','value'=>old('email')));
                        echo "<label class=\"form-label text-danger\">".session('errors.email')."<label></div>";

                        //Etiqueta e input para contraseña
                        echo "<div class=\"mb-1\"><label for=\"password\" class=\"form-label\">Contraseña</label>";
                        echo form_password(array('id'=>'password','name'=>'Password','class'=>'form-control','placeholder'=>'Ingrese su contraseña...'));
                        echo "<label class=\"form-label text-danger\">".session('errors.password')."<label></div>";

                        //Etiqueta e input para confirmar contraseña
                        echo "<div class=\"mb-1\"><label for=\"c-password\" class=\"form-label\">Confirmar contraseña</label>";
                        echo form_password(array('id'=>'c-password','name'=>'c-password','class'=>'form-control','placeholder'=>'Ingrese nuevamente su contraseña...'));
                        echo "<label class=\"form-label text-danger\">".session('errors.c-password')."<label></div>";

                        //Botón de enviar
                        echo form_input(array('id'=>'enviar','name'=>'enviar','value'=>'Registrarse','type'=>'submit','class'=>'btn btn-primary mx-auto d-block'));
                        echo form_close();
                        ?>
                    </div>                 
                </div>
            </div>
        </div>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
</html>