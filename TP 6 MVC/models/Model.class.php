<?php

abstract class Model{
    private static $pdo;
// Fonction qui va gérer la connexion à la base de données (en private par sécurité)
    private static function setBdd(){
        self :: $pdo =new PDO("mysql:host=localhost;dbname=zsite;charset=utf8","root");
        self :: $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    //Fonction getBdd() en protected qui nous permettra de récupérer $PDO dans notre MainCOntroller
    protected function getBdd(){
        if(self::$pdo ===null){
            self::setBdd();
        }
        return self::$pdo;
    }
}

?>