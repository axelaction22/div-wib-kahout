<?php

class Securite{
    public static function secureHTML($chaine){
        return htmlentities($chaine);
    }
    public static function estConnecte(){
        return (!empty($_SESSION['profil']));
    }
    public static function estUtilisateur(){
        return ($_SESSION['profil']['role'] === "utilisateur");
    }
    public static function estProfesseur(){
        return ($_SESSION['profil']['role']==="professeur");
    }
    public static function estAdministrateur(){
        return ($_SESSION['profil']['role']==="administrateur");
    }
}

?>