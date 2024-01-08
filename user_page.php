<?php

include __DIR__ . '/app/classes/User.php';
if (isset($_SESSION['funcionario']) && $_SESSION['funcionario'] !== null) {
  $nome = $_SESSION['funcionario']['nome'];
  $session_id = $_SESSION['funcionario']['id'];
} else {
  header("location: index.php");
}

$funcionario_status = $_SESSION['funcionario']['funcionario_status'];



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

  <title>Bater Ponto</title>

</head>

<body>

  <?php   
    include __DIR__.'/navbar.php';
  ?>

  <main>
    <div class="cotainer">
      <!-- <div class="row"> -->
      <div class="col text-center mt-5">
        <p class="fs-2 fw-bold">Hora Atual:</p>
        <p class="fs-4 fw-bold" id="hora-atual"></p>
        <input type="hidden" id="id-funcionario" name="id-funcionario" value="<?php echo $session_id ?>">
        <?php 
          if($funcionario_status == 0){
            echo '<button name="ponto" class="btn btn-danger" id="bater-ponto" disabled> Bater ponto</button>';
          }
          else{
        ?>
        <button name="ponto" class="btn btn-danger" id="bater-ponto"> Bater ponto</button>
        <button id="espera" class="btn btn-primary" disabled style="display: none;"> Batendo ponto...</button>
        <?php 
          }
        ?>
      </div>

      <!-- <div class="row"> -->

      <div class="col mt-5 d-flex flex-column align-items-center">
        <p class="fs-2 fw-bold">Último ponto batido: </p>
        <p class="fs-4 fw-bold text-center" id="ultima-marcacao"></p>
        <div class="fs-4 fw-bold rounded w-25 text-center" id="result"></div>
        
      </div>
    </div>
    </div>
    </div>

  </main>
  <script src="js/jquery-3.7.1.min.js"></script>
  <script src="js/ajax.js"></script>
  <script src="js/script.js"></script>
</body>

</html>