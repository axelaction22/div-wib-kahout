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

    
    public function getIDUtilisateur($login){
        $req = "SELECT id_utilisateur FROM utilisateurs WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['id_matiere'];
    }

    public function linkUtilisateurMatiere($id_matiere,$id_utilisateur){
        //fct pour s'inscrire a un cours
        $req ="INSERT INTO etudier(id_etudiant,id_cours) VALUES (:,:id_matiere)";
        $stmt=$this->getBdd()->prepare($req);
        $stmt->bindValue(":id_matiere",$id_matiere,PDO::PARAM_INT);
        $stmt->bindValue(":id_utilisateur",$id_utilisateur,PDO::PARAM_INT);
        $stmt->execute();
        $estModifier=($stmt->rowCount()>0);
        $stmt->closeCursor();
        return $estModifier;



    }


}

?>