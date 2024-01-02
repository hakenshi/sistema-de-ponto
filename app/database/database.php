<?php
    class database{

    public static $pdo;  
    private $localhost;
    private $user;
    private $password;
    private $database;

    public function connect(){
     
    $this->localhost = 'localhost';
    $this->user = 'root';
    $this->password = '';
    $this->database = 'sistema_de_ponto';

    try {
        self::$pdo = new PDO("mysql:dbname=".$this->database."; host=".$this->localhost,$this->user,$this->password);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    catch (PDOException $e) {
       echo "ERROR".$e->getMessage();
       exit();
    }

    return self::$pdo;
}

   
}