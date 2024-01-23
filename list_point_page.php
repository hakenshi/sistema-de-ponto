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
}

$admin = new Admin;

if(isset($_POST['nome'])){
   echo $admin->listarPontos($_POST['nome']);
}
else{  
$pontos = $admin->listarPontos();
}

$nomes = $admin->listarUsuarios();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Control Panel</title>
</head>

<body>
   <?php
   include __DIR__ . '/navbar-admin.php';
   ?>
   <div class="container">
      <div class="row">
         <h1 class="p-4 text-center">Tabela de pontos</h1>
         <div class="d-flex fle">
            <div class="col-3 p-4">
            
               <select class="form-select p-3" name="nome" id="nome">
                  <option value="0">Escolha um usuario</option>
                  <?php
                     foreach ($nomes as $nome) {
                        echo "<option value=".$nome['nome'].">".$nome['nome']."";
                     }
                  ?>
               </select>
         </div>
         <div class="col align-self-end p-4">
            <button class="btn btn-danger">Filtrar</button>
         </div>
         </div>
         <div class="col table-responsive-md ">
            <table class="table table-bordered  table-sm" id="listar-usuarios">
               <thead class="text-center" style="background-color: #da0037; color: white;">
                  <tr>
                     <th class="p-2 text-center">Nome</th>
                     <th class="p-2 text-center">Email</th>
                      <th class="p-2 text-center">CPF</th>
                     <th class="p-2 text-center">Matrícula</th>
                     <th class="p-2 text-center">Cargo</th>
                     <th class="p-2 text-center">Data de Nascimento</th>
                     <th class="p-2 text-center">Data de Admissão</th>
                     <th class="p-2 text-center">Ponto</th>
                     <th class="p-2 text-center">Entrada / Saida</th>
                     <th class="p-2 text-center">Cordendas</th>   
                  </tr>
               </thead>
               <tbody>
                  <?php
                  foreach ($pontos as $ponto) {
                     echo "<tr>";
                     echo "<td class='text-center'>". $ponto['nome'] . "</td>";
                     echo "<td class='text-center'>". $ponto['email'] . "</td>";
                     echo "<td class='text-center'>". $ponto['cpf'] . "</td>";
                     echo "<td class='text-center'>". $ponto['matricula'] . "</td>";
                     echo "<td class='text-center'>". $ponto['cargo'] . "</td>";
                     echo "<td class='text-center'>". $ponto['data_nascimento'] . "</td>";
                     echo "<td class='text-center'>". $ponto['data_admissao'] . "</td>";
                     echo "<td class='text-center'>". $ponto['ponto'] . "</td>";
                     echo "<td class='text-center'>" . $ponto['ponto_tipo'] . "</td>";
                     echo "<td class='text-center'>". $ponto['latitude'] . " , " . $ponto['longitude'] . "</td>";
                     echo "</tr>";
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
   <script src="js/jquery-3.7.1.min.js"></script>
   <script src="js/ajax-adm.js"></script>
</body>

</html>