<?php 
session_start(); 
include './funciones.php';
$nombre = $_SESSION['nombre'];
if (!$nombre){
    header("Location: ./index.php");
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de switches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./estilos/app.css">

</head>

<body>
    <img src="./img/fondologin.jpg" id="fondo">
    <div class="container">

        <?php Funciones::setcabecera($nombre); ?>
        <main id="main" class="p-3">

        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const sw = urlParams.get('sw')
    if (sw) {
        fetch(`./verswitch.php?sw=${sw}`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('main').innerHTML = html;
                configurarModalModificarPuerto()
            })
    }
    </script>
</body>

</html>