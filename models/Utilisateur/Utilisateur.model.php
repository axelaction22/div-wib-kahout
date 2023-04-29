<?php
require_once("./models/MainManager.model.php");


class utilisateurManager extends MainManager{

    private function getPasswordUser($login){
        $req = "SELECT password FROM utilisateurs WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req); 
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['password'];
        
    }

    public function isCombinaisonValide($login,$password){
        $passwordBD =$this->getPasswordUser($login);
        return password_verify($password,$passwordBD);
    }


    public function estCompteActive($login){
        $req ="SELECT est_valide FROM utilisateurs WHERE login =:login";
        $stmt =$this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $resultat=$stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return((int)$resultat['est_valide'] === 1) ? true :false;
    }

    public function getUserInformation($login){
        $req = "SELECT * FROM utilisateurs WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req); 
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
        
    }


    public function bdModificationMailUser($login,$mail){
        $req="UPDATE utilisateurs set mail = :mail WHERE login=:login";
        $stmt=$this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->bindValue(":mail",$mail,PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount()>0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdModificationPassword($login,$password){
        $req="UPDATE utilisateurs set password = :password WHERE login=:login";
        $stmt=$this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->bindValue(":password",$password,PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount()>0);
        $stmt->closeCursor();
        return $estModifier;
    }
}

?>