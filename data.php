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

$sql = "SELECT * FROM `elbiofernandez` ORDER BY date DESC";
$result = $conn->query($sql);



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
            <li><input type="radio" checked>Problema Técnico</input></li>
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


/*
    echo <<< EOT
        <div class="text-center">
        EOT;
        echo "<h1>A nombre de: " . $row["salonNum"]. "</h1><h3>Necesita:</h3>" . $row["need"]. "<br><br>";
    
        //echo <<< EOT
        //<h3>Tiene: </h3>
        //EOT;
    
        if($row["technicalIssue"] == 1){
        echo <<< EOT
        <form>
        <input type="radio" id="technicalIssue" name="fav_language" value="technicalIssue" checked>
        <label for="technicalIssue">Problema tecnico</label><br>
        </form>
        EOT;
        }else{
        echo <<< EOT
        EOT;
        }
        
        if($row["healthProblem"] == 1){
            echo <<< EOT
            <form>
            <input type="radio" id="healthProblem" name="fav_language" value="healthProblem" checked>
            <label for="healthProblem">Problema de salud</label><br>
            </form>
            EOT;
        }else{
            echo <<< EOT
            EOT;
        }
    
        if($row["needsCleaning"] == 1){
            echo <<< EOT
            <form>
            <input type="radio" id="needsCleaning" name="fav_language" value="needsCleaning" checked>
            <label for="needsCleaning">Necesita limpieza</label><br>
            </form>
            EOT;
        }else{
        }
    
    
        if($row["other"] == null){
    
        }else{
            echo "";
            echo "<h3>Otros comentarios:</h3>" . $row["other"]. "<br><br>";
        }
      
      ?>
          <a type="Button" class="btn btn-warning" href="delete.php?id=<?php echo $row['id']; ?>">Iniciar</a>
      <?php
    
        echo "<hr style='border-top: 1px dashed green;'>";
    
    
    
        echo "</div>";

*/

?>
<html>
  
  <head>
      <title>Data</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>

</html>

    