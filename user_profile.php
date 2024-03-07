<?php

require __DIR__ . '/app/database/database.php';
require __DIR__ . '/app/classes/User.php';

$objUser = new User();
if (isset($_SESSION['funcionario']) && $_SESSION['funcionario'] !== null) {
    $nome = $_SESSION['funcionario']['nome'];
    $session_id = $_SESSION['funcionario']['id'];
} else {
    header("location: index.php");
}

$idade = (new DateTime($_SESSION['funcionario']['data_nascimento']))->diff(new DateTime())->y;
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #DA0037;">
            <a class="navbar-brand" href="#"></a>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item">

                    </li>
                </ul>
            </div>
            <div class="d-flex p-2">

                <a class="nav-link px-3 text-light" href="user_page.php">Voltar</a>
                <a class="nav-link px-3 text-light" href="logout.php">Sair</a>

            </div>
        </nav>
    </header>
    <main>

        <div class="container p-5">
                <div class="row" >
                    <div class="col text-center mt-3">
                        <h1>Olá, <?php echo $nome ?> </h1>
                    </div>
                </div>
                <div class="col-md-4 offset-sm-4">
                    <form id="editUser" enctype="multipart/form-data">
                        <div class="form-floating my-3">
                            <input class="form-control" type="text" name="username" id="username" value="<?php echo $nome ?>" placeholder="<?php echo $_SESSION['funcionario']['nome'] ?>">
                            <label for="username">Nome</label>
                        </div>
                        <div class="form-floating my-3">
                            <input class="form-control" type="text" name="email" id="email" value="<?php echo $_SESSION['funcionario']['email'] ?>" placeholder="<?php echo $_SESSION['funcionario']['email'] ?>">
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" type="date" name="birth-date" id="birth-date">
                            <label for="birth-date">Data de nascimento</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" type="password" name="password" id="password" placeholder="Insira uma senha">
                            <label for="passowrd">Nova senha</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" type="password" name="password-confirm" id="password-confirm" placeholder="Confirme sua senha">
                            <label for="password-confirm" >Confirmar senha</label>
                        </div>
                        <!-- <div class="form-group mb-3">
                            <label for="profile-file">Alterar foto de perfil</label>
                            <input class="form-control" type="file" name="profile-file" id="profile-file">
                        </div> -->

                        <button type="submit" class="btn btn-primary col-md-10 offset-4 w-25">
                            Enviar
                        </button>

                    </form>
                </div>
            </div>
        </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
        var birthDate = "<?php echo $_SESSION['funcionario']['data_nascimento']; ?>";
        document.getElementById("birth-date").value = birthDate;
        
    </script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/ajax-user.js"></script>
</body>

</html>