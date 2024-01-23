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

$funcionarios = $admin->listarUsuarios();



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
         <h1 class="p-4 text-center">Tabela de Funcionários</h1>
         <div class="col table-responsive-md ">
            <table class="table table-bordered table-sm" id="listar-usuarios">
               <thead class="text-center" style="background-color: #da0037; color: white;">
                  <tr>
                     <th class="px-3 text-center">Tipo</th>
                     <th class="px-3 text-center">Turno</th>
                      <th class="px-3">Nome</th>
                     <th class="px-3">E-mail</th>
                     <th class="px-3">CPF</th>
                     <th class="px-3">Matrícula</th>
                     <th class="px-3">Cargo</th>
                     <th class="px-3">Data de Nascimento</th>
                     <th class="px-3">Data de Admissão</th>
                     <th class="px-3"></th>
                     <th class="px-3">Status</th>
                  </tr>
               </thead>
               <tbody class="">
                  <?php
                  foreach ($funcionarios as $funcionario) {
                     echo "<tr>";
                     echo "<td>" . ($funcionario['id_tipo'] == '1' ? 'Funcionário' : 'Adminsitrador') . "</td>";
                     echo "<td>" . $objUser->exibeTurnos($funcionario['id_turno'])['hora_entrada']. " - ". $objUser->exibeTurnos($funcionario['id_turno'])['hora_saida'] . "</td>";
                     echo "<td>" . $funcionario['nome'] . "</td>";
                     echo "<td>" . $funcionario['email'] . "</td>";
                     echo "<td>" . $funcionario['cpf'] . "</td>";
                     echo "<td>" . $funcionario['matricula'] . "</td>";
                     echo "<td>" . $funcionario['cargo'] . "</td>";
                     echo "<td>" .date('d/m/Y', strtotime($funcionario['data_nascimento'])) . "</td>";
                     echo "<td>" . date('d/m/Y', strtotime($funcionario['data_admissao'])) . "</td>";
                     echo "<td><a href='manage_users.php?id=".$funcionario['id']."'><button class='btn btn-primary'>  Editar </button></a> </td>";
                     echo "<td><button onclick='alterarStatus(".$funcionario['id'].", ".$funcionario['funcionario_status'].")' class='status btn ".($funcionario['funcionario_status'] == '1' ? 'btn-danger' : 'btn-success')."'>".($funcionario['funcionario_status'] == '1' ? "Inativar" : "Ativar")."</button> </td>";
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