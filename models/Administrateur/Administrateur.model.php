<?php
require_once("./models/MainManager.model.php");

class AdministrateurManager extends MainManager{
    public function getUtilisateur(){
        $req = $this->getBdd()->prepare("SELECT * FROM utilisateurs");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }

    public function bdModificationRoleUser($login,$role){
        $req = "UPDATE utilisateurs set role = :role WHERE login = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":role", $role, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }
}