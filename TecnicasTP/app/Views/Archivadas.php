<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GT - Archivadas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link href="<?= base_url()?>estilos/estilos.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    </head>
    <body>
        <?= view('layouts/header.php') ?>

        <div class="card">
            <div class="card-header text-center text-bg-primario">
                Tareas archivadas
            </div>
            <!-- Panel de tareas -->
            <table class="table card-body">
                <tr>
                    <th>Titulo</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                    <th>Fecha de fin</th>
                </tr>
                <?php 
                    foreach($tareas as $tarea){
                ?> 
                        <tr class="<?php if($tarea['CodigoColor'] != NULL) echo $colores[$tarea['CodigoColor']]; ?>">    
                            <td><a class="<?php if($tarea['CodigoColor'] != NULL) echo $colores[$tarea['CodigoColor']]; ?>" href="<?= base_url()."tarea/".$tarea['Codigo']?>"><?= $tarea['Titulo'] ?></a></td>
                            <td><?= $tarea['Prioridad'] ?></td>
                            <td><?= $tarea['Estado'] ?></td>
                            <td><?= $tarea['FechaVencimiento'] ?></td>                        
                        </tr>
                <?php } ?>
            </table>

            <div class="mt-5 card">
            <div class="card-header text-center text-bg-secundario">
                Subtareas archivadas
            </div>
            <!-- Panel de subtareas -->
            <table class="table card-body">
                <tr>
                    <th>Titulo</th>
                    <th>Prioridad</th>
                    <th>Estado</th>
                    <th>Fecha de fin</th>
                </tr>
                <?php
                    foreach($subtareas as $subtarea){
                ?>
                        <tr class="<?php if($subtarea['CodigoColor'] != NULL) echo $coloresSubtareas[$subtarea['CodigoColor']]; ?>">
                            <td><a class="<?php if($subtarea['CodigoColor'] != NULL) echo $coloresSubtareas[$subtarea['CodigoColor']]; ?>" href="<?= base_url()."subtarea/".$subtarea['Codigo'] ?>"><?= $subtarea['Titulo'] ?></a></td>
                            <td><?php if($subtarea['CodigoPrioridad'] != NULL) echo $prioridades[$subtarea['CodigoPrioridad']]; ?></td>
                            <td><?= $subtarea['Estado'] ?></td>
                            <td><?= $subtarea['FechaVencimiento'] ?></td>                        
                        </tr>
                <?php } ?>
            </table>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    </body>
</html>