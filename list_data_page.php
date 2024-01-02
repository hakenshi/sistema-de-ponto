<?php
include __DIR__ . '/app/classes/Admin.php';
include __DIR__ . '/app/classes/User.php';

if (isset($_SESSION['funcionario']) && $_SESSION['funcionario'] !== null) {
   $nome = $_SESSION['funcionario']['nome'];
   $session_id = $_SESSION['funcionario']['id'];
} else {
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
   <title>Document</title>
</head>

<body>
   <?php
   include __DIR__ . '/navbar-admin.php';
   ?>
   <div class="container">
      <div class="row">
         <h1 class="p-4 text-center">Usuários Cadastrados no sistema</h1>
         <div class="col table-responsive-md ">
            <table class="table table-bordered table-sm" id="listar-usuarios">
               <thead class="text-center" style="background-color: #da0037; color: white;">
                  <tr>
                     <th class="px-3 text-center">Tipo</th>
                     <th class="px-3 text-center">Turno</th>
                     <th class="px-3">Nome</th>
                     <th class="px-3">Email</th>
                     <th class="px-3">Cpf</th>
                     <th class="px-3">Matricula</th>
                     <th class="px-3">Cargo</th>
                     <th class="px-3">Data de nascimento</th>
                     <th class="px-3">Data de Admissao</th>
                     <th class="px-3"></th>
                     <th class="px-3"></th>
                  </tr>
               </thead>
               <tbody class="">
                  <?php
                  foreach ($funcionarios as $funcionario) {
                     echo "<tr>";
                     echo "<td>" . ($funcionario['id_tipo'] == '1' ? 'Funcionário' : 'Adminsitrador') . "</td>";
                     echo "<td>" . $funcionario['nome'] . "</td>";
                     echo "<td>" . $funcionario['email'] . "</td>";
                     echo "<td>" . $funcionario['cpf'] . "</td>";
                     echo "<td>" . $funcionario['matricula'] . "</td>";
                     echo "<td>" . $funcionario['cargo'] . "</td>";
                     echo "<td>" . $funcionario['data_nascimento'] . "</td>";
                     echo "<td>" . $funcionario['data_admissao'] . "</td>";
                     echo "<td><a href='manage_users.php?=".$funcionario['id']."'><button class='btn btn-primary'>  Editar </button></a> </td>";
                     echo "<td><button class='btn btn-danger'> Inativar </button> </td>";
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