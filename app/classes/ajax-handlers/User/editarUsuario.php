<?php 
require __DIR__ . "/../../../classes/User.php";
require __DIR__ . "/../../../classes/Admin.php";


$user = new User;
$admin = new Admin;

$id = $_SESSION['funcionario']['id'];

if(isset($_POST['username'],$_POST['email'], $_POST['password'],$_POST['birthDate'])){

echo $user->editarUsuario($_POST['username'],  $_POST['email'],  $_POST['password'], $_POST['birthDate'], $id);

}