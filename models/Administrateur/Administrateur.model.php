<?php
require_once("./models/MainManager.model.php");

class AdministrateurManager extends MainManager{
    public function getUtilisateur(){
        $req = $this->getBdd()->prepare("SELECT * FROM utilisateur");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }
}