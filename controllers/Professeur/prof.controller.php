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
        $matieres = $this->profManager->bdgetMatieres();

        $data_page = [
            "page_description" => "Page de création de quizz",
            "page_title" => "Page de création de quizz",
            "view" => "views/Professeur/creerQuizz.view.php",
            "template" => "views/common/template.php",
            "matieres" => $matieres
        ];
        $this->genererPage($data_page);
    }

    public function voirMesQuizz(){
        $id_prof=$this->profManager->getIDUtilisateur($_SESSION['profil']['login'] );
        $quizz =$this->profManager->bdgetQuizzProf($id_prof);
        $data_page = [
            "page_description" => "Page d'observation des quizz",
            "page_title" => "Page d'observation des quizz",
            "quizz" => $quizz,
            "view" => "views/Professeur/voirMesQuizz.view.php",
            "template" => "views/common/template.php"
        ];
        
        $this->genererPage($data_page);
        
    }


    public function editQuizz($id_quizz){
        $data_page=[
            "page_description" => "Page de modification du quizz",
            "page_title"=>"Page de modification du quizz",
            "view"=>"views/Professeur/editquizz.view.php",
            "template"=>"views/common/template.php"
        ];
        $this->genererPage($data_page);
    }



    public function creerQuestion($type,$enonce,$reponses,$id_quizz){
        if($this->profManager->bdajoutQuestion($type,$enonce,$reponses,$id_quizz)){
            ToolBox::ajouterMessageAlerte("Vous avez crée une question !",ToolBox::COULEUR_VERTE);
            header('Location: '.URL.'compte/editQuizz');
        }else  {
            ToolBox::ajouterMessageAlerte("La question ne s'est pas crée! ", Toolbox::COULEUR_ROUGE);
            header('Location: '.URL.'compte/editQuizz');
        }
    }
    
}
