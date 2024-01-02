<?php

if (isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['senha']) && !empty($_POST['senha'])) {

     require __DIR__ . '/app/database/database.php';
     require __DIR__ . '/app/classes/User.php';

     $objUser = new User();

     $login = addslashes($_POST['login']);
     $senha = addslashes($_POST['senha']);

    if($objUser->login($login,$senha) == true){
          if($_SESSION['funcionario']['id_tipo'] == 2){
          header("Location: list_data_page.php");
     }
     elseif($_SESSION['funcionario']['id_tipo'] == 1){
          header("location: user_page.php");
     }
         
    }else{
     header("location: index.php");
    }


} 
else {
     header("location: index.php");
}
