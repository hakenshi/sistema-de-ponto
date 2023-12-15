<?php 

    session_unset();
    session_destroy();
    unset($_SESSION['funcionario']);
    header("location: index.php");
    
?>