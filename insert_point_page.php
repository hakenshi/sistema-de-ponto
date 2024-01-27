<?php
include __DIR__ . '/app/classes/User.php';
include __DIR__ . '/app/classes/Admin.php';

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

$turnos = $objUser->exibeTurnos();

$tipoFuncionarios = $objUser->exibeTipoFuncionario();

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

   <!DOCTYPE html>
   <html lang="pt-br">

   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Formulário de Cadastro de Funcionário</title>
   </head>

   <body>
      <?php
      include __DIR__ . '/navbar-admin.php';
      ?>
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-md-6">
               <h2 class="my-4 text-center">Registro de Pontos</h2>
               <form id="registrar-ponto">
               <div class="mb-4">
                  <label class="form-label" for="data">Data</label>
                  <input class="form-control" type="date" id="data" name="data" autocomplete="off" >
               </div>
               <div class="mb-4">
                  <label class="form-label" for="hora">Hora</label>
                  <input class="form-control" type="time" id="hora" name="hora" autocomplete="off" step="2">
               </div>
               
               <div class="mb-4">
                  <label class="form-label" for="idFuncionario">Funcionário: </label> <br>
                  <select class="custom-select" name="idFuncionario" id="idFuncionario">
                  <option value="0">Selecione um funcionário</option>
                     <?php
                     foreach ($funcionarios as $funcionario) {
                        if($funcionario['id'] === 1) continue;
                        echo "<option  value=" . $funcionario['id'] . ">" . $funcionario['nome'] . "</option>";
                     }
                     ?> 
                  </select>
               </div>
               <p>Marcação de entrada e saída:</p>
               <div class="mb-4">
                  <div class="form-check form-check-inline">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="ponto"
                        id="entrada"
                        value="E"
                    />
                    <label class="form-check-label" for="entrada">Entrada</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="ponto"
                        id="saida"
                        value="S"
                    />
                    <label class="form-check-label" for="saida">Saida</label>
                  </div>      
               </div>
               <button class="btn btn-danger mt-3">Registrar Ponto</button>
            </div>
            </form>
         </div>
      </div>
   </body>

   </html>
   <script src="js/jquery-3.7.1.min.js"></script>
   <script src="js/ajax-adm.js"></script>   
</body>

</html>