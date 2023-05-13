<?php 
    $session = session();
    $usuario = $_SESSION['usuario'];
    if($session->has('errors')){
       echo "<script>alert(\"".session('errors.responsable')."\")</script>";
    }
?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GT - Subtarea</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>estilos/estilos.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    </head>
    <body>
        <?= view('layouts/header.php') ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-bg-light">
                    <div class="card-body d-flex justify-content-between align-items-center py-2">
                        <div>
                            <a href="<?= base_url()."tarea/".$subtarea['CodigoT'] ?>" class="text-dark"><?= $subtarea['TituloT'] ?></a> - Subtarea: <?= $subtarea['Titulo']; ?>   
                        </div>                        
                        <div>
                            <!-- Si el usuario logeado es el mismo que creo el curso -->
                            <?php if($usuario == $subtarea['CodigoUsuario']){?>
                                <button type="button" class="btn btn-primario btn-sm me-2" data-bs-toggle="modal" data-bs-target="#eliminarSubtarea">Eliminar</button>

                                <!-- Modal - Confirmar eliminar subtarea-->
                                <div class="modal fade" id="eliminarSubtarea" tabindex="-1" aria-labelledby="eliminarSubtareaLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="eliminarSubtareaLabel">¿Seguro desea eliminar la subtarea?</h1>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?= base_url()."subtarea/borrarSubtarea/".$subtarea['Codigo'] ?>" class="btn btn-primario">Si</a>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            
                            
                            <!-- Si el usuario logeado es el mismo que creo el curso o el colaborador del mismo -->
                            <?php if($usuario == $subtarea['CodigoUsuario'] || $usuario == $subtarea['CodigoColaborador']){?>
                                <!-- Boton que activa modal para seleccionar el color -->
                                <a href="#" data-bs-toggle="modal" data-bs-target="#colorPicker">
                                    <img src="<?= base_url() ?>imagenes/cromatico.png" class="btn-colores me-5" alt="circulo cromatico">
                                </a>                      

                            <!-- Modal -->
                            <div class="modal fade" id="colorPicker" tabindex="-1" aria-labelledby="colorPickerLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="colorPickerLabel">Seleccione un color</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="text-center" method="POST" action="<?= base_url() ?>subtarea/formColor/<?= $subtarea['Codigo']?>">
                                                <input type="radio" class="btn-check" name="selColor" value="text-bg-primary" id="azul" autocomplete="off" <?php if($subtarea['Color'] == 'text-bg-primary') echo"checked" ?>>
                                                <label class="btn btn-outline-primary" for="azul"></label>

                                                <input type="radio" class="btn-check" name="selColor" value="text-bg-secondary" id="gris" autocomplete="off" <?php if($subtarea['Color'] == 'text-bg-secondary') echo"checked" ?>>
                                                <label class="btn btn-outline-secondary" for="gris"></label>

                                                <input type="radio" class="btn-check" name="selColor" value="text-bg-success" id="verde" autocomplete="off" <?php if($subtarea['Color'] == 'text-bg-success') echo"checked" ?>>
                                                <label class="btn btn-outline-success" for="verde"></label>

                                                <input type="radio" class="btn-check" name="selColor" value="text-bg-danger" id="rojo" autocomplete="off" <?php if($subtarea['Color'] == 'text-bg-danger') echo"checked" ?>>
                                                <label class="btn btn-outline-danger" for="rojo"></label>

                                                <input type="radio" class="btn-check" name="selColor" value="text-bg-warning" id="amarillo" autocomplete="off" <?php if($subtarea['Color'] == 'text-bg-warning') echo"checked" ?>>
                                                <label class="btn btn-outline-warning" for="amarillo"></label>

                                                <input type="radio" class="btn-check" name="selColor" value="text-bg-info" id="celeste" autocomplete="off" <?php if($subtarea['Color'] == 'text-bg-info') echo"checked" ?>>
                                                <label class="btn btn-outline-info" for="celeste"></label>

                                                <input type="radio" class="btn-check" name="selColor" value="text-bg-dark" id="negro" autocomplete="off" <?php if($subtarea['Color'] == 'text-bg-dark') echo"checked" ?>>
                                                <label class="btn btn-outline-dark me-4" for="negro"></label>

                                                <input class="btn btn-outline" type="radio" name="selColor" id="sc" value="">
                                                <label class="form-check-label" for="exampleRadios2">Sin color</label>

                                                <div class="modal-footer mt-3">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <input type="submit" class="btn btn-primary" name="guardar" id="guardar" value="Guardar">
                                                </div>
                                            </form>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?> 
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card m-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <!-- boton que activa el formulario para activar cambiar el estado (MODAL)-->

                                <!-- Azul - Definida -->
                                <?php if($subtarea['Estado'] == 'Definida'){ ?>
                                    <button type="button" class="btn btn-primary btn-sm mt-3 ms-3" data-bs-toggle="modal" data-bs-target="#btnEstado">
                                <?php
                                    // Verde - En proceso 
                                    }if($subtarea['Estado'] == 'En proceso'){ ?>
                                    <button type="button" class="btn btn-success btn-sm mt-3 ms-3" data-bs-toggle="modal" data-bs-target="#btnEstado">
                                <?php 
                                    //Rojo - Finalizada
                                    }if($subtarea['Estado'] == 'Finalizada'){ ?>
                                    <button type="button" class="btn btn-danger btn-sm mt-3 ms-3" data-bs-toggle="modal" data-bs-target="#btnEstado">
                                <?php } ?>
                                    <?= $subtarea['Estado']; ?>
                                </button>

                                <!-- Solo les permito cambiar el estado del curso al dueño del mismo o a su colaborador -->
                                <?php if($usuario == $subtarea['CodigoUsuario'] || $usuario == $subtarea['CodigoColaborador']){ ?>
                                <!-- MODAL -->
                                <div class="modal fade" id="btnEstado" tabindex="-1" aria-labelledby="btnEstadoLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="btnEstadoLabel">Seleccione un estado</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="<?= base_url()."subtarea/formEstado/".$subtarea['Codigo'] ?>">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="selEstado" id="definida" value="Definida" <?php if($subtarea['Estado'] == 'Definida') echo"checked"; ?> disabled>
                                                        <label class="form-check-label" for="definida">Definida</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="selEstado" id="enProceso" value="En proceso" <?php if($subtarea['Estado'] == 'En proceso') echo"checked"; ?>>
                                                        <label class="form-check-label" for="enProceso">En proceso</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="selEstado" id="finalizada" value="Finalizada" <?php if($subtarea['Estado'] == 'Finalizada') echo"checked"; ?>>
                                                        <label class="form-check-label" for="finalizada">Finalizada</label>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                                    </div>
                                                </form>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <p class="card-text">Creada el <?= date("d/m/Y", strtotime($subtarea['FechaCreacion'])); ?> - Resposable: <?= $subtarea['NombreResponsable'] ?>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card m-3">
                        <div class="card-body">
                            <h5 class="card-title">Descripcion</h5>
                            <p class="card-text"><?= $subtarea['Descripcion'] ?></p>
                        </div>
                    </div>    
                </div>

                <div class="col-12">
                    <div class="container-fluid">
                        <div class="row m-2">
                            <div class="col-md-4 alert alert-danger" role="alert">
                                <div class="mb-2">Prioridad: <?php echo $subtarea['Prioridad']; 
                                //Si es el dueño de la tarea le permito modificar la prioridad
                                if($usuario == $subtarea['CodigoUsuario']){ ?> 
                                    <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#cambiarPrioridad">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <!-- Modal - cambiar prioridad-->
                                    <div class="modal fade text-dark" id="cambiarPrioridad" tabindex="-1" aria-labelledby="cambiarPrioridadLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="cambiarPrioridadLabel">Seleccione una prioridad</h1>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url()."subtarea/formPrioridad/".$subtarea['Codigo'] ?>" method="POST">
                                                        <select class="form-select" aria-label="Default select example" name="selPrioridad">
                                                            <option value="Baja" <?php if($subtarea['Prioridad'] == 'Baja') echo "selected" ?>>Baja</option>
                                                            <option value="Normal" <?php if($subtarea['Prioridad'] == 'Normal') echo "selected" ?>>Normal</option>
                                                            <option value="Alta" <?php if($subtarea['Prioridad'] == 'Alta') echo "selected" ?>>Alta</option>
                                                        </select>
                                                        <hr class="my-3">
                                                        <button class="btn btn-primario" type="submit">Guardar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                      
                                <?php } ?></div>
                                <div class="mb-2">Fecha de vencimiento: <?= $subtarea['FechaVencimiento'] ?></div>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <span></span>
                                    <!-- Botón activa modal para seleccionar responsable (Solo dueño de la tarea)-->
                                    <?php if($subtarea['CodigoUsuario'] == $usuario){ ?>
                                        <button type="button" class="btn btn-primario btn-sm me-2" data-bs-toggle="modal" data-bs-target="#asignarResponsable">Asignar responsable</button>

                                        <!-- Modal - Confirmar eliminar subtarea-->
                                        <div class="modal fade" id="asignarResponsable" tabindex="-1" aria-labelledby="asignarResponsableLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="eliminarSubtareaLabel">Asignar responsable</h1>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="<?= base_url()."subtarea/formResponsable/".$subtarea['Codigo'] ?>">
                                                             <select id="responsable" name="responsable" class="form-select">
                                                                <option selected disabled>Seleccione un responsable...</option>
                                                                <?php foreach($usuarios as $usuario){ ?>
                                                                    <option value="<?= $usuario['Codigo'] ?>"><?= $usuario['Apellido']." ".$usuario['Nombre'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <hr class="mt-3 mb-3">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primario">Asignar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>       
                        </div>
                    </div>                    
                </div>

                <hr>

                <!-- seccion de comentarios -->
                <?php foreach($comentarios as $comentario){ ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <?= $comentario['Nombre']." ".$comentario['Apellido'] ?>
                                
                                <!-- Solo para el dueño de la tarea -->
                                <?php if($subtarea['CodigoUsuario'] == $usuario){ ?>
                                    <a href="<?= base_url()."comentario/borrarComentario/".$comentario['Codigo']."/".$subtarea['Codigo']; ?>" class="rounded border-1"><i class="bi bi-trash3-fill"></i></a>
                                <?php } ?>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><?= $comentario['Comentario'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
</html>