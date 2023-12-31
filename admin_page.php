<?php
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


$turnos = $objUser->exibeTurnos();

$tipoFuncionarios = $objUser->exibeTipoFuncionario();

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
            <div class="col-md-7">
               <h2 class="my-4 text-center">Cadastrar Funcionário</h2>
               <form id="cadastrar-funcionario">
               <div class="mb-4">
                  <label class="form-label" for="nome">Nome</label>
                  <input class="form-control" type="text" id="nome" name="nome" autocomplete="off" >
               </div>
               <div class="mb-4">
                  <label class="form-label" for="email">Email</label>
                  <input class="form-control" type="text" id="email" name="email" autocomplete="off">
               </div>
               <div class="mb-4">
                  <label class="form-label" for="senha">Senha</label>
                  <input class="form-control" type="password" id="senha" name="senha" autocomplete="off">
               </div>
               <div class="mb-4">
                  <label class="form-label" for="cpf">CPF</label>
                  <input class="form-control" type="text" id="cpf" name="cpf" autocomplete="off" maxlength="14" placeholder="399.049.970-04">
               </div>
               <div class="mb-4">
                  <label class="form-label" for="matricula">Matrícula</label>
                  <input class="form-control" type="text" id="matricula" name="matricula" autocomplete="off">
               </div>
               <div class="mb-4">
                  <label class="form-label" for="turno">Turnos: </label> <br>
                  <select class="custom-select" name="turno" id="turno">
                     <option>Selecione um turno</option>
                     <?php
                     foreach ($turnos as $turno) {
                        echo "<option value=" . $turno['id'] . ">" . $turno['hora_entrada'] . " - " . $turno['hora_saida'] . "</option>";
                     }
                     ?> 
                  </select>
               </div>
               <div class="mb-4">
                  <label class="form-label" for="tipo_funcionario">Tipo de funcionário: </label> <br>
                  <select class="custom-select" name="tipo_funcionario" id="tipo_funcionario">
                  <option>Selecione um tipo de funcionário</option>
                     <?php
                     foreach ($tipoFuncionarios as $tipoFuncionario) {
                        echo "<option value=" . $tipoFuncionario['id'] . ">" . $tipoFuncionario['user_type'] . "</option>";
                     }
                     ?> 
                  </select>
               </div>
               <div class="mb-4">
                  <label class="form-label" for="cargo">Cargo</label>
                  <input class="form-control" type="text" id="cargo" name="cargo" autocomplete="off">
               </div>
               <div class="mb-4">
                  <label class="form-label" for="data_nascimento">Data de nascimento</label>
                  <input class="form-control" type="date" id="data_nascimento" name="data_nascimento" autocomplete="off">
               </div>
               <button class="btn btn-danger my-5" type="submit">Cadastrar Funcionário</button>
            </div>
            </form>
         </div>
      </div>
      </div>
      </div>

   </body>

   </html>
   <script src="js/jquery-3.7.1.min.js"></script>
   <script src="js/ajax-adm.js"></script>
   <script>
        const cpf = document.querySelector("#cpf")

        cpf.addEventListener('keypress', ()=>{
            let cpfLength = cpf.value.length

            if (cpfLength === 3 || cpfLength === 7) {
                cpf.value += '.'
            }
            else if(cpfLength === 11){
                cpf.value += '-'
            }
        })
    </script>
   
   
</body>

</html>