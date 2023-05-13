<?php
    if(session('errors')){
        if(session('errors.pAnterior'))
            echo "<script>alert(\"".session('errors.pAnterior')."\")</script>";
        if(session('errors.pNueva'))
            echo "<script>alert(\"".session('errors.pNueva')."\")</script>";
        if(session('errors.pConfirmar'))
            echo "<script>alert(\"".session('errors.pConfirmar')."\")</script>";
    }
?>

<header>
    <!-- menu de navegación -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="<?= base_url() ?>"><img src="<?= base_url()?>imagenes/Logo-GT.png" class="logo-header" alt="Logo del sitio"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menú responsive -->
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <span class="navbar-nav me-auto mb-2 mb-lg-0 d-flex"></span>
                <ul class="navbar-nav mb-2 mb-lg-0 d-flex">
                    <li class="nav-item">
                        <a class="nav-link <?php if($_SERVER['PHP_SELF'] == '/TecnicasTP/index.php'){ echo "active"; }?>" aria-current="page" href="<?= base_url() ?>">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>archivadas">Archivadas</a>
                    </li>
                </ul>
                <div class="dropdown-center">
                    <a type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div><img class="perfil-miniatura" src="<?= base_url() ?>imagenes/usuarios/usuario.png"></i></div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#cPassword">Cambiar contraseña</a></li>
                        <li>
                            <form action="<?= base_url() ?>cerrarSesion" method="POST">
                                <input type="submit" name="cerrarSesion" class="dropdown-item" value="Cerrar sesión">
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Modal -->
<div class="modal fade" id="cPassword" tabindex="-1" aria-labelledby="cPasswordLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="cPasswordLabel">Cambiar contraseña</h1>        
      </div>
      <div class="modal-body">
        <form action="<?= base_url()."registrarse/cambiarPassword/".$usuario ?>" method="POST">
            <div class="mb-3">
                <label class="form-label">Contraseña anterior</label>
                <input class="form-control" type="password" name="pAnterior">
            </div>
            <div class="mb-3">
                <label class="form-label">Nueva contraseña</label>
                <input class="form-control" type="password" name="pNueva">
            </div>
            <div class="mb-3">
                <label class="form-label">Confirmar contraseña</label>
                <input class="form-control" type="password" name="pConfirmar">
            </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primario">Cambiar</button>
        </form>
      </div>
    </div>
  </div>
</div>