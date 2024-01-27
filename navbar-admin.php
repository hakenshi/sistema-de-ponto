<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>
   <link rel="stylesheet" href="css/mediaquery.css">  
   <script src="js/dropdown.js"></script>

<!-- <div class="container"> -->

<!-- ============= COMPONENT ============== -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #DA0037;">
 <div class="container-fluid">
	<a class="navbar-brand" href="#"><img src="css/imgs/placeholder-icon.png" class="d-inline-block" width="40px" style="margin-left: 25px;"></a>
	<a class="nav-link text-light" href="#" aria-current="page">Olá, <?php echo $_SESSION['funcionario']['nome']?></a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  <div class="collapse navbar-collapse" id="main_nav">
	
	<ul class="navbar-nav ms-auto text-left">
		<li class="nav-item"><a class="nav-link active" href="admin_page.php">Cadastrar funcionário </a></li>
		<li class="nav-item"><a class="nav-link active" href="insert_point_page.php">Registrar Ponto</a></li>
		<li class="nav-item"><a class="nav-link active" href="list_data_page.php">Ver dados</a></li>
		<li class="nav-item"><a class="nav-link active" href="list_point_page.php">Ver pontos</a></li>
		<li class="nav-item"><a class="nav-link active" href="logout.php">Sair</a></li>
	</ul>

  </div> <!-- navbar-collapse.// -->
 </div> <!-- container-fluid.// -->
</nav>
