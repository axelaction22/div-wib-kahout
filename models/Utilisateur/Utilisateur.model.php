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


    public function verifLoginDisponible($login){
        $utilisateur = $this->getUserInformation($login);
        return empty($utilisateur);
    }


    public function bdCreerCompte($login,$passwordCrypte,$email,$clef,$image,$role){
        $req ="INSERT INTO utilisateurs(login,password,email,est_valide,role,clef,image) VALUES (:login, :password, :email , 0 , :role , :clef , :image)";
        $stmt=$this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->bindValue(":password",$passwordCrypte,PDO::PARAM_STR);
        $stmt->bindValue(":email",$email,PDO::PARAM_STR);
        $stmt->bindValue(":clef",$clef,PDO::PARAM_INT);
        $stmt->bindValue(":image",$image,PDO::PARAM_STR);
        $stmt->bindValue(":role",$role,PDO::PARAM_STR);
        $stmt->execute();
        $estModifier=($stmt->rowCount()>0);
        $stmt->closeCursor();
        return $estModifier;
    }


    public function bdModificationMailUser($login,$email){
        $req="UPDATE utilisateurs set email = :email WHERE login=:login";
        $stmt=$this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->bindValue(":email",$email,PDO::PARAM_STR);
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



    public function bdValidationMailCompte($login,$clef){
        $req="UPDATE utilisateurs set est_valide =1 WHERE login =  :login and clef = :clef";
        $stmt=$this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->bindValue(":clef",$clef,PDO::PARAM_INT);
        $stmt->execute();
        $estModifier = ($stmt->rowCount()>0);
        $stmt->closeCursor();
        return $estModifier;
    }
}

?>