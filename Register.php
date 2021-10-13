<?php
// Include config file
require_once "config.php";


session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 0){
    header("location: /elbiosalonhelper/welcome.php");
    exit;
  }
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $admin ="";
$username_err = $password_err = $confirm_password_err = $confirm_admin_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Ingrese un nombre de usuario.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "El nombre de usuario solo puede tener letras, numeros y guion bajo.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Ya existe este nombre de usuario.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Error.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Ingresa una contraseña.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "La contraseña necesita 6 caracteres minimos.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirma la contraseña.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Las contraseñas no son iguales.";
        }
    }

    if(empty(($_POST["admin"]))){
        $confirm_admin_err = "Ingrese si o no.";     
    } else{
        if(($_POST["admin"]) == "si" || ($_POST["admin"]) == "Si" || ($_POST["admin"]) == "yes" || ($_POST["admin"]) == "Yes"){
            $admin = "1";
        }else{
            $admin = "0";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        $param_admin = $admin;

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, admin) VALUES (?, ?, $admin)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Error.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script> 
    <style>
        body{ font: 14px sans-serif; }
        .wrapper
        {
            display:flex;
  flex-direction: column;
  width: 100%;
  justify-content: center;
  align-items: center;
           }
    </style>
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
            <a class="btn btn-warning nav-link" href="welcome.php">Volver</a>
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
    <div class="text-center text-white">
        <div class="wrapper">
            <h1>Registrar nuevo usuario</h1>
            <h5>ELEF-SM</h5>
            <br>
            <br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Nombre de usuario</label>
                    <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                    <span class="invalid-feedback"><?php echo $username_err; ?></span>
                </div>    <br>
            <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div> <br>
                <div class="form-group">
                    <label>Confirmar contraseña</label>
                    <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div> <br>
                <div class="form-group">
                    <label>Admin</label>
                    <input placeholder="Sí, no." type="text" name="admin" class="form-control <?php echo (!empty($confirm_admin_err)) ? 'is-invalid' : ''; ?>" value="">
                    <span class="invalid-feedback"><?php echo $confirm_admin_err; ?></span>
                </div> <br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Crear cuenta">
                </div>
            </form>
        </div> 
    </div>    
</body>
</html>