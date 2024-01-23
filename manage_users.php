<?php
include __DIR__ . '/app/classes/User.php';
include __DIR__ . '/app/classes/Admin.php';

if (isset($_SESSION['funcionario']) && $_SESSION['funcionario'] !== null && $objUser->checkAdmin() == 2 && isset($_GET['id'])) {
   $nome = $_SESSION['funcionario']['nome'];
} else {
   header("location: index.php");
}

$admin = new Admin;

$id = $_GET['id'];

$funcionario = $admin->listarUsuarios($id);

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
      <?php
      include __DIR__ . '/navbar-admin.php';
      ?>
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-md-7">
               <h2 class="my-4 text-center">Editar Funcionário</h2>
               <form id="editar-funcionario" method="post">
               <div class="mb-4">
                  <label class="form-label" for="nome">Nome</label>
                  <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                  <input class="form-control" type="text" id="nome" name="nome" autocomplete="off" value="<?php echo $funcionario['nome'] ?>">
               </div>
               <div class="mb-4">
                  <label class="form-label" for="email">Email</label>
                  <input class="form-control" type="text" id="email" name="email" autocomplete="off" value="<?php echo $funcionario['email'] ?>">
               </div>
               <div class="mb-4">
                  <label class="form-label" for="senha">Senha</label>
                  <input class="form-control" type="password" id="senha" name="senha" autocomplete="off" placeholder="Senha">
               </div>
               <div class="mb-4">
                  <label class="form-label" for="cpf">CPF</label>
                  <input class="form-control" type="text" id="cpf" name="cpf" autocomplete="off" value="<?php echo $funcionario['cpf'] ?>">
               </div>
               <div class="mb-4">
                  <label class="form-label" for="matricula">Matrícula</label>
                  <input class="form-control" type="text" id="matricula" name="matricula" autocomplete="off" value="<?php echo $funcionario['matricula'] ?>">
               </div>
               <div class="mb-4">
                  <label class="form-label" for="turno">Turnos</label>
                  <select class="custom-select" name="turno" id="turno">
                  <option value="0">Selecione um turno</option>
                     <?php
                     foreach ($turnos as $turno) {
                        if($turno['id'] == $funcionario['id_turno']){
                        echo "<option selected value=" . $turno['id'] . ">" . $turno['hora_entrada'] . " - " . $turno['hora_saida'] . "</option>";
                     }
                     else{
                        echo "<option value=" . $turno['id'] . ">" . $turno['hora_entrada'] . " - " . $turno['hora_saida'] . "</option>";
                     }
                     }
                     ?> 
                  </select>
               </div>
               <div class="mb-4">
                  <label class="form-label" for="tipo_funcionario">Tipo de funcionário</label>
                  <select class="custom-select" name="tipo_funcionario" id="tipo_funcionario">
                  <option value="0">Selecione um tipo de funcionário</option>

                     <?php
                     foreach ($tipoFuncionarios as $tipoFuncionario) {
                        if($tipoFuncionario['id'] == $funcionario['id_tipo']){
                        echo "<option selected value=" . $tipoFuncionario['id'] . ">" . $tipoFuncionario['user_type'] . "</option>";
                     }
                     else{
                        echo "<option value=" . $tipoFuncionario['id'] . ">" . $tipoFuncionario['user_type'] . "</option>";
                     }
                     }
                     ?> 
                  </select>
               </div>
               <div class="mb-4">
                  <label class="form-label" for="cargo">Cargo</label>
                  <input class="form-control" type="text" id="cargo" name="cargo" autocomplete="off" value="<?php echo $funcionario['cargo'] ?>">
               </div>
               <div class="mb-4">
                  <label class="form-label" for="data_nascimento">Data de nascimento</label>
                  <input class="form-control" type="date" id="data_nascimento" name="data_nascimento" autocomplete="off" value="<?php echo $funcionario['data_nascimento'] ?>">
               </div>
               <button class="btn btn-danger my-5" type="submit">Salvar</button>
            </div>
            </form>
         </div>
      </div>

   <script src="js/jquery-3.7.1.min.js"></script>
   <script src="js/ajax-adm.js"></script>
</body>

</html>