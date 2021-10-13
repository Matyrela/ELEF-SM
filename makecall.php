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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Hacer pedidos</title>
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
                <a class="nav-link" href="#">Hacer pedidos</a>
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
<h1 class='text-center display-1 text-white text-danger'><strong>Hacer pedidos</h1>
<hr class='my-2 text-white' style='margin: 0% 7% 0px 7%;'> <br>
<form action="insert.php" method="post">
    <p>
        <label for="username">Pedido de:</label><br>
        <input value=" <?php echo($_SESSION["username"]); ?>" type="text" name="username" id="username">
    </p>
    <p>
        <label for="need">Se necesita:</label><br>
        <input type="text" name="need" id="need">
    </p>
    <p>
        <input type="checkbox" id="technicalIssue" name="technicalIssue" value="1">
        <label for="technicalIssue">Problema técnico</label>
    </p>
    <p>
        <input type="checkbox" id="healthProblem" name="healthProblem" value="1">
        <label for="healthProblem">Problema de salud</label>
    </p>
    <p>
        <input type="checkbox" id="needsCleaning" name="needsCleaning" value="1">
        <label for="needsCleaning">Necesita limpieza: </label>
    </p>
    <p>
        <label for="other">Otros comentarios:</label><br>
        <input type="text" name="other" id="other">
    </p>  
    <input class="btn btn-success" type="submit" value="Pedir">
    </form>
    </div>

    <br><br>

    

<?php
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
$user = $_SESSION["username"];
$sql = "SELECT * FROM `elbiofernandez` WHERE `salonNum` LIKE '%$user%';";
$result = $conn->query($sql);

if($result->num_rows < 10){
    echo "<h1 class='text-center text-white display-1'>Pedidos de ";
    echo $_SESSION["username"];
    echo ": ";
    echo ($result->num_rows);
    echo "</h1>";
}else if($result->num_rows <= 19){
    echo "<h1 class='text-center display-1 text-white text-warning'><strong>Pedidos de ";
    echo $_SESSION["username"];
    echo ": ";
    echo ($result->num_rows);
    echo "</strong></h1>";
}else if($result->num_rows > 19){
    echo "<h1 class='text-center display-1 text-white text-danger'><strong>Pedidos de ";
    echo $_SESSION["username"];
    echo ": ";
    echo ($result->num_rows);
    echo "</strong></h1>";
}
echo "<hr class='my-2 text-white' style='margin: 0% 7% 0px 7%;'>";

echo '<div class="container row row-cols-1 row-cols-md-4 g-3 text-center mx-auto text-white">';

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        echo <<< EOT
        <div class="col">
        EOT;

        if($row["healthProblem"] == 1){
            echo <<< EOT
            <div class="card text-white bg-danger mb-3" style="min-width: 100%; box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75); -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75); -moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);">
            EOT;
        }else if ($row["technicalIssue"] == 1){
            echo <<< EOT
            <div class="card text-white bg-warning mb-3" style="min-width: 100%; box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75); -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75); -moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);">
            EOT;
        }else if ($row["needsCleaning"] == 1){
            echo <<< EOT
            <div class="card text-white bg-success mb-3" style="min-width: 100%; box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75); -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75); -moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);">
            EOT;
        }else{
            echo <<< EOT
            <div class="card text-white bg-secondary mb-3" style="min-width: 100%; box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75); -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75); -moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);">
            EOT;
        }

        echo <<< EOT
        <div class="card-header"><h4 class="card-title text-">{$row['salonNum']}</h5></div>
                <div class="card-body" style="margin: 10px;">
                    <h5 class="card-title">Necesita</h5>
                    <p class="card-text">{$row['need']}</p>
                    <ul class="" style="list-style-type: none; text-align: justify;">
        EOT;


        if($row['other'] != null){
        echo <<< EOT
            <h5 class="card-title">Otros comentarios</h5>
            <p class="card-text">{$row['other']}</p>
        EOT;
        }

        if($row["technicalIssue"] == 1){
            echo <<< EOT
            <li><input type="radio" checked>Tecnico</input></li>
            EOT;
        }

        if($row["healthProblem"] == 1){
            echo <<< EOT
            <li><input type="radio" checked>Ayuda medica</input></li>
            EOT;
        }

        if($row["needsCleaning"] == 1){
            echo <<< EOT
            <li><input type="radio" checked>Limpieza</input></li>
            EOT;
        }

        echo <<< EOT
                </ul>
                </div>
                <div class="card-footer">
                    <p> {$row['date']}</p>
                    <a class="btn btn-primary" href="delete.php?id={$row['id']}" >Borrar</a>
                </div>
            </div>
        </div>   
        EOT;
           

        
      }
    } else {
      echo "<div class='text-center'>";
      echo "<h3 style='text-center'>No hay pedidos</h3>";
      echo "</div>";
    }

$conn->close();
?>
</div>

</body>
</html>