<?php


class VisiteurController extends MainController{
    private $visiteurManager;

    public function __construct()
    {
        $this->visiteurManager =new VisiteurManager();
    }

    public function accueil(){
        $data_page =[
         "page_description"=>"Description de la page d'accueil",
         "page_title"=>"Titre de la page d'accueil",
         "view"=>"./views/Visiteur/accueil.view.php",
         "template"=>"views/common/template.php"
        ];  
        $this->genererPage($data_page);
     }
}
?>

