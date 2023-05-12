<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Proyecto de aplicación de gestión de redes para DWES">
    <meta name="author" content="Felipe Hommen Mansilla">
    <meta name="generator" content="Hugo 0.108.0">
    <title>Gestión de redes - login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="./estilos/login.css" rel="stylesheet">
</head>

<body class="text-center">
    <?php
	  if (isset($_POST['submit'])) {
        // Recibimos datos de login del formulario
        include './basededatos.php';
        $bd = new basededatos;
        $usuario=$_POST["usuario"];
        $password=$_POST["password"];
        if($filas=$bd->compruebaUsuario($usuario,$password))
		 {
            session_start();
			$_SESSION['nombre'] = $filas['nombre'];
			header("Location: ./app.php");
		 }
		
	   } else{
        if (isset($_GET['logout'])){
            // Venimos del botón logout de la cabecera de la app
            session_start();
            unset($_SESSION['nombre']);
        }
	?>
    <main class="form-signin w-100 m-auto">
        <form method="post">
            <img class="mb-4" src="./img/logo.png" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Gestión de redes</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"
                    name="usuario">
                <label for="floatingInput">Usuario</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                    name="password">
                <label for="floatingPassword">Contraseña</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Entrar</button>
            <p class="mt-5 mb-3 text-muted">Felipe Hommen Mansilla</p>
        </form>
    </main>

    <?php } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>