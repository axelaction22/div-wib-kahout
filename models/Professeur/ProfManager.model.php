<?php

require_once("./models/MainManager.model.php");

class ProfManager extends MainManager{

    public function linkMatiereProf($id_prof, $id_matiere){
        //necessite de connaitre l'id du professeur et de la matiere a associer, a répeter pour chaque prof

        $req ="INSERT INTO enseigner(id_prof,id_matieree) VALUES (:id_prof, :id_matiere)";
        $stmt=$this->getBdd()->prepare($req);
        $stmt->bindValue(":id_matiere",$id_matiere,PDO::PARAM_INT);
        $stmt->bindValue(":id_prof",$id_prof,PDO::PARAM_INT);
        $stmt->execute();
        $estModifier=($stmt->rowCount()>0);
        $stmt->closeCursor();
        return $estModifier;


    }

    public function bdAjoutMatiere($nom_matiere,$langue){
        //!\ n'associe pas la matiere a des professeurs (voir linkMatiereProf) ni a des eleves

        $req ="INSERT INTO matiere(nom_matiere,langue) VALUES (:nom_matiere, :langue)";
        $stmt=$this->getBdd()->prepare($req);
        $stmt->bindValue(":nom_matiere",$nom_matiere,PDO::PARAM_STR);
        $stmt->bindValue(":langue",$langue,PDO::PARAM_STR);
        $stmt->execute();
        $estModifier=($stmt->rowCount()>0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function getIDMatiere($nom_matiere){
        $req = "SELECT id_matiere FROM matiere WHERE nom_matiere = :nom_matiere";
        $stmt = $this->getBdd()->prepare($req); 
        $stmt->bindValue(":nom_matiere",$nom_matiere,PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['id_matiere'];
    }


    public function bdajoutQuizz($diplome,$nom_matiere){
        $id_matiere = $this->getIDMatiere($nom_matiere);
        $req ="INSERT INTO quizz(diplome,id_matiere) VALUES (:diplome,:id_matiere)";
        $stmt=$this->getBdd()->prepare($req);
        $stmt->bindValue(":diplome",$diplome,PDO::PARAM_STR);
        $stmt->bindValue(":id_matiere",$id_matiere,PDO::PARAM_INT);
        $stmt->execute();
        $estModifier=($stmt->rowCount()>0);
        $stmt->closeCursor();
        return $estModifier;
    }

    
    public function bdajoutQuestion($type,$enonce,$reponses,$id_quizz){
        $req ="INSERT INTO question(type,enonce,reponses,id_quizz) VALUES (:type,:enonce,:reponses,:id_quizz)";
        $stmt=$this->getBdd()->prepare($req);
        $stmt->bindValue(":type",$type,PDO::PARAM_STR);
        $stmt->bindValue(":enonce",$enonce,PDO::PARAM_STR);
        $stmt->bindValue(":reponses",$reponses,PDO::PARAM_STR);
        $stmt->bindValue(":id_quizz",$id_quizz,PDO::PARAM_INT);
        $stmt->execute();
        $estModifier=($stmt->rowCount()>0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdgetMatieres(){
        $req = $this->getBdd()->prepare("SELECT nom_matiere FROM matiere");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }

    public function bdgetQuizzProf($id_createur){
        $req = "SELECT * FROM quizz WHERE id_createur = :id_createur";
        $stmt = $this->getBdd()->prepare($req); 
        $stmt->bindValue(":id_createur",$id_createur,PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }



    public function getIDUtilisateur($login){
        $req = "SELECT id_utilisateur FROM utilisateurs WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req); 
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['id_utilisateur'];
    }

   


}