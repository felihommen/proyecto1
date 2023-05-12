<?php
// Este archivo contiene "trozos" del sitio web
include './basededatos.php';

/**
 * Funciones que añaden contenido a la página
 * @author Felipe Hommen Mansilla
 */
class Funciones
{
    /**
     * Función que añade la cabecera
     * @param string $nombre nombre de usuario
     * @return void
     * 
     */
    public static function setcabecera($nombre)
    {
        $bd = new basededatos;
        $switches = $bd->getNswitch();
        $redes = $bd->getRedes();
?>
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Redes</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Switches
                                </a>
                                <ul class="dropdown-menu">
                                    <?php
                                    foreach ($switches as $row) {
                                        echo "<li><a class=dropdown-item data-sw=$row[0] href=#>$row[0]</a></li>";
                                    }
                                    ?>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" href="#modal-nuevo-switch">Nuevo
                                            switch</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Redes</a>
                                <ul class="dropdown-menu">
                                    <!--
                            <php
                            foreach($redes as $row){
                                echo "<li><a class=dropdown-item data-red=$row[0] href=#>$row[1]$row[2]</a></li>";
                            }
                            ?>
                            -->
                                    <li><a class="dropdown-item" href="javascript:verRedes()">Ver redes</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" href="#modal-nueva-red">Nueva red</a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                        <span class="navbar-text">
                            <?php echo $nombre; ?>
                        </span>
                        <ul class="navbar-nav ms-3">
                            <li class="nav-item">
                                <a class="bi-power" href="./index.php?logout"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Modal añadir switch -->
        <div class="modal fade" id="modal-nuevo-switch" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-nuevo-switch-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal-nuevo-switch-label">Añadir switch</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formnuevoswitch" method="post" action="./operaciones.php">
                            <div class="row">
                                <div class="col">
                                    <label for="nombreswitch" class="form-label">Nombre</label>
                                    <input type="text" maxlength="10" class="form-control" id="nombreswitch" name="nombre" required>
                                </div>
                                <div class="col">
                                    <label for="puertosswitch" class="form-label">Número de puertos</label>
                                    <input type="number" min="1" class="form-control" id="puertosswitch" name="puertos" required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" form="formnuevoswitch" name="addswitch">Añadir</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal añadir red -->
        <div class="modal fade" id="modal-nueva-red" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-nueva-red-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal-nueva-red-label">Añadir red</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formnuevared" method="post" action="./operaciones.php">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="direccionred" class="form-label">Dirección de red</label>
                                    <input type="text" class="form-control" id="direccionred" name="direccion" required pattern="^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$" placeholder="192.168.1.1">
                                </div>
                                <div class="col">
                                    <label for="mascarared" class="form-label">Máscara</label>
                                    <input type="text" class="form-control" id="mascarared" name="mascara" required pattern="^(\/([1-9]|[1-2][0-9]|3[0-2]))$" placeholder="/24">
                                </div>
                            </div>
                            <label for="descripcionred" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="descripcionred" name="descripcion" required>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" form="formnuevared" name="addred">Añadir</button>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function verRedes() {
                fetch('./verredes.php')
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById('main').innerHTML = html
                    })
            }

            function configurarModalModificarPuerto() {
                const modal = document.getElementById('modalEditPuerto')
                const formulario = document.getElementById('formModificarPuerto')

                // Al mostrarse el diálogo, rellenar las casillas y el título
                modal.addEventListener('show.bs.modal', event => {
                    const origen = event.relatedTarget

                    const sw = origen.dataset.sw
                    const descripcion = origen.dataset.descripcion
                    const puerto = origen.dataset.puerto
                    const cod = origen.dataset.cod

                    const titulo = modal.querySelector('.modal-title')
                    const casilla = modal.querySelector('.modal-body input[name="descripcion"]')
                    const campoCod = modal.querySelector('.modal-body input[name="cod"]')
                    const campoSw = modal.querySelector('.modal-body input[name="sw"]')

                    titulo.textContent = `Modificar puerto ${puerto} del switch ${sw}`
                    casilla.value = descripcion
                    campoCod.value = cod
                    campoSw.value = sw
                })

                // Al enviarse el formulario, no recargar la página, sino solo enviarlo y cuando termine recargar verswitch
                formulario.addEventListener('submit', event => {
                    event.preventDefault()

                    const data = new FormData(formulario)
                    data.append('modificarpuerto', '')
                    const sw = data.get('sw')

                    fetch('./operaciones.php', {
                        method: 'POST',
                        body: data
                    }).then(respuesta => {
                        window.location.replace(`./app.php?sw=${sw}`)
                    })
                })
            }


            for (link of document.querySelectorAll('a[data-sw]')) {
                link.addEventListener('click', e => {
                    e.preventDefault();
                    const sw = e.target.dataset.sw;
                    fetch(`./verswitch.php?sw=${sw}`)
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('main').innerHTML = html;
                            configurarModalModificarPuerto()
                        })
                })
            }
        </script>
<?php
    }
}
?>