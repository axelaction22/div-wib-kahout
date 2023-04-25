<?php


require_once("./controllers/MainController.controller.php");
require_once("./models/Administrateur/Administrateur.controller.php");


class AdministrateurController extends MainController{
    private $administrateurManager;

    public function __construct(){
        $this->administrateurManager=new AdministrateurManager();
    }

    public function droits(){
        $utilistateurs=$this->administrateurManager->getUtilisateur();

        $data_page=[
            "page_description"=>"Gestion des droits",
            "page_title"=>"Gestion des droits",
            "utilisateurs"=>$utilistateurs,
            "view"=>"views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function pageErreur($msg){
        parent::pageErreur($msg);
    }
}
?>
