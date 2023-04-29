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

    public function validation_login($login,$password){
        if ($this->utilisateurManager->isCombinaisonValide($login,$password)){
            if($this->utilisateurManager->estCompteActive($login)){
                ToolBox::ajouterMessageAlerte("Bon retour parmi nous ".$login." !",ToolBox::COULEUR_VERTE);
                $_SESSION['profil'] =[
                    "login" => $login,
                ];
                header("location: ".URL."compte/profil");
            }else{
                ToolBox::ajouterMessageAlerte("Le compte ".$login." n'a pas encore été activé par mail",ToolBox::COULEUR_ROUGE);
                //renvoyer le mail de vérification
                header("Location: ".URL."login");
            }
        }else{
            ToolBox::ajouterMessageAlerte("Combinaison Login / Mode de passe non valide", Toolbox::COULEUR_ROUGE);
            header("Location: ".URL."login");
        }
    }


    public function profil(){
        $datas= $this->utilisateurManager->getUserInformation($_SESSION['profil']['login']);
        $_SESSION['profil']["role"]=$datas['role'];

        $data_page =[
            "page_descritpion" => "Page de profil",
            "page_title"=>"Page de profil",
            "utilisateur"=>$datas,
            "page_javascript"=>['profil.js'],
            "view"=>"views/Utilisateur/profil.view.php",
            "template"=>"views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    


}

?>