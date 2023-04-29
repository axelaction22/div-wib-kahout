<?php

//Récupération du model MainManager

require_once("./models/MainManager.model.php");
require_once("controllers/Toolbox.class.php");

/*
Création de l'instance de mon manager et du constructeur.
Nous pourrons ainsi accéder au data de notre model MainManager
*/

abstract class MainController{

    protected function genererPage($data){
        extract($data);
        ob_start();
        require_once($view);
        $page_content=ob_get_clean();
        require_once($template);
    }
    public function login(){
        $data_page=[
            "page_description"=>"Page de connexion",
            "page_title"=>"Page de connexion",
            "view"=>"views/Visiteur/login.view.php",
            "template"=>"views/common/template.php"
        ];
        $this->genererPage($data_page);
    }
    protected function pageErreur($msg){
        $data_page =[
            "page_description" => "Page pour les erreurs",
            "page_title" =>"Page d'erreur",
            "msg"=>$msg,
            "view" => "./views/erreur.view.php",
            "template" => "views/common/template.php"
           ];
           $this->genererPage($data_page);
    }

    

}
?>