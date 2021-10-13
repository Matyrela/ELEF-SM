<!DOCTYPE html>
<html>
  
<head>
    <title>Nuevo Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
  
<body>
    <center>
        <?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include "config.php";

        error_reporting(0);
  if($_REQUEST['username'] == null){
        echo "<br><br><br><br><br><br>";
        echo "No puedes acceder a esta pagina.";
        echo "<br>";echo "<br>";
        echo '<a type="Button" class="btn btn-warning" href="welcome.php" role="button">Volver</a>';
  }else{
    if($_REQUEST['need'] == null){
        echo "<br><br><br><br><br><br>";
        echo "No puedes hacer un pedido vacio.";
        echo "<br>";echo "<br>";
        echo '<a type="Button" class="btn btn-warning" href="welcome.php" role="button">Volver</a>';

  }else{
    
        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
          
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. " 
                . mysqli_connect_error());
        }
          
        $salonNum = $_REQUEST['username'];

        $need =  $_REQUEST['need'];
        if(($_REQUEST['technicalIssue']) == null){
            $technicalIssue = 0;
        }else{
            $technicalIssue = 1;
        }

        if(($_REQUEST['healthProblem']) == null){
            $healthProblem = 0;
        }else{
            $healthProblem = 1;
        }

        if(($_REQUEST['needsCleaning']) == null){
            $needsCleaning = 0;
        }else{
            $needsCleaning = 1;
        }

        $other = $_REQUEST['other'];
          
        // Performing insert query execution
        // here our table name is college
        $sql = "INSERT INTO `elbiofernandez` (`id`, `salonNum`, `need`, `technicalIssue`, `healthProblem`, `needsCleaning`, `other`, `date`) VALUES (NULL, '$salonNum', '$need','$technicalIssue','$healthProblem','$needsCleaning', '$other', date_format(current_timestamp(),'%a - %d/%m - %l:%i %p'));";
        //$sql = "INSERT INTO `elbiofernandez` VALUES ('*', '$salonNum', '$need','$technicalIssue','$healthProblem','$needsCleaning', '$other')";
          
        if(mysqli_query($conn, $sql)){
            echo "<h3>Hecho</h3>"; 
  
            echo nl2br("\n$salonNum\n $need\n "
                . "$technicalIssue\n $healthProblem\n $needsCleaning\n $other \n $other");

                echo <<< EOT
                </br>
                </br>
                <a class="btn btn-warning" href="welcome.php" role="button">Volver</a>
                EOT;
        } else{
            echo "ERROR $sql. " 
                . mysqli_error($conn);
        }
          
        // Close connection
        mysqli_close($conn);
        header("location: makecall.php");
    }
  }
    
        ?>
    </center>
</body>
  
</html>