<?php
include __DIR__ . '/app/classes/Admin.php';
include __DIR__ . '/app/classes/User.php';



if (isset($_SESSION['funcionario']) && $_SESSION['funcionario'] !== null && $objUser->checkAdmin() == 2) {
   $nome = $_SESSION['funcionario']['nome'];
   $session_id = $_SESSION['funcionario']['id'];
} else {
   session_unset();
   session_destroy();
   unset($_SESSION['funcionario']);
   header("location: index.php");
   die;
}

$admin = new Admin;
$pontos = $admin->listarPontos();

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/all.min.css">
   <title>Admin Control Panel</title>
</head>

<body>
   <?php
   include __DIR__ . '/navbar-admin.php';
   ?>
   <div class="container">
      <div class="row justify-content-center align-items-center flex-row">
         <h1 class="m-0 p-4 text-center">Tabela de pontos</h1>
         <div class="col-7 p-4 ">
            <input type="hidden" id="id-funcionario" name="id-funcionario" value="">
            <input class="form-control-sm mx-2" type="text" name="nome" id="nome" placeholder="Insira um nome">
            <input class="form-control-sm mx-2" type="date" name="data-inicial" id="data-inicial" placeholder="Insira um data-inicial">
            <input class="form-control-sm mx-2" type="date" name="data-final" id="data-final" placeholder="Insira uma data final">
            <button id="filtrar" class="btn btn-primary mx-2 mb-2">Filtrar</button>
            <button id="reset" class="btn btn-danger mx-2 mb-2">Reset</button>
         </div>
      </div>
      <div class="row justify-content-center flex-row">
         <div class="col-auto mb-3">
            <div class="form-check form-check-inline">
               <input class="form-check-input" type="radio" name="ordem" id="asc" checked />
               <label class="form-check-label" for="asc">Ordem Crescente</label>
            </div>
            <div class="form-check form-check-inline">
               <input class="form-check-input" type="radio" name="ordem" id="desc" />
               <label class="form-check-label" for="desc">Ordem Decrescente</label>
            </div>
         </div>
      </div>
      <div class="row justify-content-center align-items-center">
         <div class=" col-10 table-responsive-md">
            <table class="table table-bordered  table-sm" id="listar-usuarios" style="width: 1000px;">
               <thead class="text-center" style="background-color: #da0037; color: white;">
                  <tr>
                     <th class="p-2 text-center">Nome</th>
                     <th class="p-2 text-center">Ponto</th>
                     <th class="p-2 text-center">Entrada / Saida</th>
                     <th class="p-2 text-center">Cordendas</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  foreach ($pontos as $ponto) {
                     echo "<tr>";
                     echo "<td class='text-center'>" . $ponto['nome'] . "</td>";
                     echo "<td class='text-center'>" . date("d-m-Y H:i:s", strtotime($ponto['ponto'])) . "</td>";
                     echo "<td class='text-center'>" . $ponto['ponto_tipo'] . "</td>";
                     echo "<td class='text-center'><a class='text-decoration-none text-dark' href='https://www.google.com/maps?q=" . $ponto['latitude'] . "," . $ponto['longitude'] . "' target='_blank'>" . $ponto['latitude'] . ", " . $ponto['longitude'] . "</a></td>";

                     echo "</tr>";
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
   </div>
   <script src="js/jquery-3.7.1.min.js"></script>
   <script src="js/ajax-filter.js"></script>
   <script>

   </script>
</body>

</html>