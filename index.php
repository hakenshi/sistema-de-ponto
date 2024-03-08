<?php 

    require __DIR__.'../app/database/database.php';
    

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-center mt-5">
                <div class="form-container text-center rounded-4 bg-light">
                    <h1 class="fw-bold">WELCOME</h1>
                    <p>Faça log-in para acessar o sistema</p>
                    <form action="login.php" method="post">
                        <div>
                            <label  for="login" class="form-label"><i class="fa-solid fa-user"></i></label>
                            <input type="text" id="login" name="login" class="p-3 fs-5 form-control" placeholder="Login">
                        </div>
                        <div class="mb-5">
                            <label for="senha" class="form-label"></label>
                            <input type="password" id="senha" name="senha" class="p-3 fs-5 form-control" placeholder="Senha">
                        </div>
                        <div class="mb-4">
                            <a href="reset-password.php" class="link-dark link-underline-opacity-0 link-underline-opacity-100-hover">Redefinir Senha</a>
                        </div>
                        <button type="submit" class="btn btn-danger " style="width: 150px;">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>  
    
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>