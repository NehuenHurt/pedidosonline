<?php

  session_start();

  if (isset($_SESSION['numeroUsu'])) {
    header('Location: /login');
  }
  require 'database.php';

  if(count($_POST)>0) {
    $con = mysqli_connect('localhost','root','','pharmavet') or die('Unable To connect');
   $result = mysqli_query($con,"SELECT * FROM usuarios WHERE nombreUsu='" . $_POST["usuario"] . "' and claveUsu = '". $_POST["password"]."'");
   $row  = mysqli_fetch_array($result);
   if(is_array($row)) {
   $_SESSION["numeroUsu"] = $row['numeroUsu'];
   $_SESSION["nombreUsu"] = $row['nombreUsu'];
   } else {
   $message = "Usuario o contraseña incorrecta!";
   }
   }
   if(isset($_SESSION["numeroUsu"])) {
   header("Location:index.php");
   }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Ingresar</h1>
    

    <form action="login.php" method="POST">
      <input name="usuario" type="text" placeholder="Ingrese su usuario">
      <input name="password" type="password" placeholder="Ingrese su contraseña">
      <input type="submit" value="Submit">
    </form>
  </body>
</html>
