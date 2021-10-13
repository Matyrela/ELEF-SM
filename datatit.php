<?php
include "config.php";

setlocale(LC_ALL,"es_UY");

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

$sql = "SELECT * FROM `elbiofernandez`";
$result = $conn->query($sql);

if($result->num_rows < 10){
    echo "<h1 class='text-center display-1'>Pedidos: ";
    echo ($result->num_rows);
    echo "</h1>";
}else if($result->num_rows <= 19){
    echo "<h1 class='text-center display-1 text-warning'><strong>Pedidos: ";
    echo ($result->num_rows);
    echo "</strong></h1>";
}else if($result->num_rows > 19){
    echo "<h1 class='text-center display-1 text-danger'><strong>Pedidos: ";
    echo ($result->num_rows);
    echo "</strong></h1>";
}

echo "<hr class='my-2' style='margin: 0% 7% 0px 7%;'>";

$conn->close();
?>
<html>
  
  <head>
      <title>Data</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>

</html>

    