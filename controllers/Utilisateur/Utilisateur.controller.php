<?php
//Récupération du controleur principal MainCOntroller
require_once("./controllers/MainController.controller.php");
//Récupération des données contenues dans le model visiteur
require_once("./models/Utilisateur/Utilisateur.model.php");

//création de l'héritage de notre class MainController
class UtilisateurController extends MainController{
    private $utilisateurManager;

    public function __construct()
    {
        $this->utilisateurManager=new utilisateurManager();
    }


}

?>