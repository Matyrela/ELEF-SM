<?php
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if($_SESSION["loggedin"] != true){
  header("location: /elbiosalonhelper/login.php");
  exit;
}
if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 0){
  header("location: /elbiosalonhelper/makecall.php");
  exit;
}

include "config.php";

$servername = DB_SERVER;
$username = DB_USERNAME;
$password = DB_PASSWORD;
$dbname = DB_NAME;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, salonNum, need, technicalIssue, healthProblem, needsCleaning, other FROM elbiofernandez";
$result = $conn->query($sql);



$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function(){
        function getData(){
            $.ajax({
                type: 'POST',
                url: 'data.php',
                success: function(data){
                    $('#output').html(data);
                }
            });
        }
        getData();
        setInterval(function () {
            getData(); 
        }, 5000);  // it will refresh your data every 5 sec

    });

    $(document).ready(function(){
        function getData(){
            $.ajax({
                type: 'POST',
                url: 'datatit.php',
                success: function(data){
                    $('#text').html(data);
                }
            });
        }
        getData();
        setInterval(function () {
            getData(); 
        }, 5000);  // it will refresh your data every 5 sec

    });
</script>
    <title>ELEF-SM</title>
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
                <a class="nav-link active" aria-current="page" href="welcome.php">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="makecall.php">Hacer pedidos</a>
            </li>
            <?php
            if ($_SESSION["admin"] == 1){

            echo <<< EOT
            <li class="nav-item">
                <a class="nav-link" href="#">Ver pedidos</a>
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
<div class="text-white">


<div class="text-white" id="text">
    

    </div>

  <div class="container row row-cols-1 row-cols-md-4 g-3 text-center mx-auto" id="output">
    

  </div>

  <div class="text-center mx-auto">
    <br>
    <br>
  </div>
  </div>
</body>
</html>