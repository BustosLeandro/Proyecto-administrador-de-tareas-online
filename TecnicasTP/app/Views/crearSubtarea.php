<?php 
    $usuario = session()->get('usuario');
?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GT - Crear subtarea</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>estilos/estilos.css">
    </head>
    <body>
        <?= view('layouts/header') ?>
        
        <!-- Formulario de crear subtarea -->
        <form action="<?= base_url()."subtarea/formSubtarea/".$codigoTarea ?>" method="POST" class="container-fluid mt-5">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-5 mb-3">
                    <label for="tituloSubtarea" class="form-label">Titulo</label>
                    <input class="form-control" id="tituloSubtarea" name="tituloSubtarea" value="<?= old('tituloSubtarea') ?>" placeholder="Ingrese el título...">
                    <label class="text-danger"><?= session('errors.tituloSubtarea') ?></label>
                </div>
                <div class="col-sm-12 col-md-5 mb-3">
                    <label for="prioridadSubtarea" class="form-label">Prioridad (OPCIONAL)</label>
                    <select id="prioridadSubtarea" name="prioridadSubtarea" class="form-select">
                        <option selected disabled>Seleccione una prioridad...</option>
                        <?php foreach($prioridades as $prioridad){ ?>
                            <option value="<?= $prioridad ?>"><?= $prioridad ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-12 col-md-5 mb-3">
                    <label for="colorSubtarea" class="form-label">Color (OPCIONAL)</label>
                    <select id="colorSubtarea" name="colorSubtarea" class="form-select">
                        <option selected disabled>Seleccione un color...</option>
                        <?php foreach($colores as $color => $valor){ ?>
                            <option value="<?= $valor ?>"><?= $color ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-12 col-md-5 mb-3">
                    <label for="descripcionSubtarea" class="form-label">Descripción</label>
                    <input class="form-control" id="descripcionSubtarea" name="descripcionSubtarea" placeholder="Ingrese la descripcion..." value="<?= old('descripcionSubtarea') ?>">
                    <label class="text-danger"><?= session('errors.descripcionSubtarea') ?></label>
                </div>
                <div class="col-sm-12 col-md-5 mb-3">
                    <label for="FechaVencimientoSubtarea" class="form-label">Fecha de vencimiento (OPCIONAL)</label>
                    <input class="form-control" type="date" id="FechaVencimientoSubtarea" name="FechaVencimientoSubtarea" value="<?= old('FechaVencimientoSubtarea') ?>">
                </div>
                <div class="col-12 text-center mb-3">
                    <input class="btn btn-primario" type="submit" value="Crear">
                </div>
            </div>
        </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
</html>