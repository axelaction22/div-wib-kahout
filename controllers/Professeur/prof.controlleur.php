<?php
//Récupération du controleur principal MainCOntroller
require_once("./controllers/MainController.controller.php");
//Récupération des données contenues dans le model visiteur
require_once("./models/Professeur/profManager.model.php");

class profController extends MainController
{
    private $profManager;

    public function __construct()
    {
        $this->profManager = new profManager();
    }


    public function creerQuizz()
    {
        $data_page = [
            "page_description" => "Page de création de quizz",
            "page_title" => "Page de création de quizz",
            "view" => "views/Professeur/creerQuizz.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }
}
