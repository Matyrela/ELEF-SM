<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>ELEF-SM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color: #333333;">

<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand">ELEF-SM</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="makecall.php">Hacer pedidos</a>
            </li>
            <?php
            if ($_SESSION["admin"] == 1){

            echo <<< EOT
            <li class="nav-item">
                <a class="nav-link" href="ELEF-SM.php">Ver pedidos</a>
            </li>
            EOT;
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="changelog.php">Cambios</a>
            </li>
            </ul>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
        <?php
            if ($_SESSION["admin"] == 1){

            echo <<< EOT
            <li class="nav-item">
                <a class="btn btn-warning nav-link" href="register.php">Crear usuario</a>
            </li>
            <li class="nav-item">
            """"
            </li>
            EOT;
            }
        ?>
                <li class="nav-item">
                    <a class="btn btn-danger nav-link" href="logout.php">Cerrar sesion</a>
                </li>   
        </ul>
    </div>
  </div>
</nav>


<div class="jumbotron text-center text-white">
    <h2 class="display-2">Hola, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bienvenido a ELEF-SM</h2>
    <h5 class="display-6">(Escuela y Liceo Elbio Fernández Salon Manager)</h5><br>
    <p>Acá se supone que va una pequeña descripción que me da pereza hacer.</p>
    

<br><br>

    <br><br>
    </div>
    <h6 class="text-center text-white h6">
        Matías Varela, V: 0.5
    </h6>
</body>
</html>
