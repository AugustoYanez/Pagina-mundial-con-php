<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>FIFA WORLD CUP</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
  </head>
  <body>



    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Bienvenido. <?= $user['email']; ?>
      <br>Estas logeado en ese correo.
      <br> Desloguearse:
      <a href="logout.php">
        Logout
      </a>
    <?php else: ?>
      <h1>Por favor inicie sesion o registrese.</h1>

      <a href="login.php">Iniciar Sesion</a> or
      <a href="signup.php">Registrarse</a>
    
      <a href="mundialmenu.php" class="menu"><br> Ir al menú</a>
    <?php endif; ?>

  </body class=bodyindex>
</html>