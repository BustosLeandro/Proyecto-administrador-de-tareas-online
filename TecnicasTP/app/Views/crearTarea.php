<?php 
    $usuario = session()->get('usuario');
?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GT - Crear tarea</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>estilos/estilos.css">
    </head>
    <body>
        <?= view('layouts/header') ?>
        
        <!-- Formulario de crear tarea -->
        <form action="<?= base_url() ?>tarea/formTarea" method="POST" class="container-fluid mt-5">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-5 mb-3">
                    <label for="tituloTarea" class="form-label">Titulo</label>
                    <input class="form-control" id="tituloTarea" name="tituloTarea" value="<?= old('tituloTarea') ?>" placeholder="Ingrese el título...">
                    <label class="text-danger"><?= session('errors.tituloTarea') ?></label>
                </div>
                <div class="col-sm-12 col-md-5 mb-3">
                    <label for="prioridadTarea" class="form-label">Prioridad</label>
                    <select id="prioridadTarea" name="prioridadTarea" class="form-select">
                        <option selected disabled>Seleccione una prioridad...</option>
                        <?php foreach($prioridades as $prioridad){ ?>
                            <option value="<?= $prioridad ?>"><?= $prioridad ?></option>
                        <?php } ?>
                    </select>
                    <label class="text-danger"><?= session('errors.prioridadTarea') ?></label>
                </div>
                <div class="col-sm-12 col-md-5 mb-3">
                    <label for="colorTarea" class="form-label">Color (OPCIONAL)</label>
                    <select id="colorTarea" name="colorTarea" class="form-select">
                        <option selected disabled>Seleccione un color...</option>
                        <?php foreach($colores as $color => $valor){ ?>
                            <option value="<?= $valor ?>"><?= $color ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-12 col-md-5 mb-3">
                    <label for="descripcionTarea" class="form-label">Descripción</label>
                    <input class="form-control" id="descripcionTarea" name="descripcionTarea" placeholder="Ingrese la descripcion..." value="<?= old('descripcionTarea') ?>">
                    <label class="text-danger"><?= session('errors.descripcionTarea') ?></label>
                </div>
                <div class="col-sm-12 col-md-5 mb-3">
                    <label for="FechaVencimientoTarea" class="form-label">Fecha de vencimiento</label>
                    <input class="form-control" type="date" id="FechaVencimientoTarea" name="FechaVencimientoTarea" value="<?= old('FechaVencimientoTarea') ?>">
                    <label class="text-danger"><?= session('errors.FechaVencimientoTarea') ?></label>
                </div>
                <div class="col-sm-12 col-md-5 mb-3">
                    <label for="FechaRecordatorioTarea" class="form-label">Fecha de recordatorio (OPCIONAL)</label>
                    <input class="form-control" type="date" id="FechaRecordatorioTarea" name="FechaRecordatorioTarea">
                </div>
                <div class="col-12 text-center mb-3">
                    <input class="btn btn-primario" type="submit" value="Crear">
                </div>
            </div>
        </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
</html>