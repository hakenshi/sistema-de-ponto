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
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        
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
        
        <a  class="nav-link px-3 text-light" href="user_page.php">Voltar</a>
        <a  class="nav-link px-3 text-light" href="logout.php">Sair</a>

      </div>
    </nav>
        </header>
        <main>

            <div class="container">
                <div class="row">
                    <div class="col d-flex justify-content-center mt-3">
                        <img src="css/imgs/placeholder-icon.png" alt="placeholder-icon">
                    </div>
                    <div class="row">
                        <div class="col text-center mt-3">
                            <h1><?php echo $nome?>, </h1>
                        </div>
                    </div>
                </div>
            </div>

        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
