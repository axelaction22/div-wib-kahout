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
            ToolBox::ajouterMessageAlerte("Combinaison Login / Mot de passe non valide", Toolbox::COULEUR_ROUGE);
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
    public function deconnexion(){
        ToolBox::ajouterMessageAlerte("La deconnexion est effectuée !",ToolBox::COULEUR_VERTE);
        unset($_SESSION['profil']);
        $_SESSION['messages'] = ToolBox::getMessagesAlerte();
        header("location: ".URL."accueil");
        exit(); // il est recommandé de sortir de la fonction après l'utilisation de header()
    }
    

    public function validation_modificationMail($mail){
        if($this->utilisateurManager->bdModificationMailUser($_SESSION['profil']['login'],$mail)){
            ToolBox::ajouterMessageAlerte("La modification est effectué",ToolBox::COULEUR_VERTE);
        }else{
            ToolBox::ajouterMessageAlerte("Aucune modification effectuée", ToolBox::COULEUR_ROUGE);
        }
        header("Location: ".URL."compte/profil");
    }


    public function modificationPassword(){
        $data_page=[
            "page_description" => "Page de modification du password",
            "page_title"=>"Page de modification du password",
            "page_javascript" => ["modificationPassword.js"],
            "view"=>"views/Utilisateur/modificationPassword.view.php",
            "template"=>"views/common/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function validation_modificationPassword($ancienPassword,$nouveauPassword,$confirmationNouveauPassword){
        if($nouveauPassword === $confirmationNouveauPassword){
            if($this->utilisateurManager->isCombinaisonValide($_SESSION['profil']['login'],$ancienPassword)){
                $passwordCrypte =password_hash($nouveauPassword,PASSWORD_DEFAULT);
                if($this->utilisateurManager->bdModificationPassword($_SESSION['profil']['login'],$passwordCrypte)){
                    ToolBox::ajouterMessageAlerte("La modification du password a été effectué",ToolBox::COULEUR_VERTE);
                    $_SESSION['messages'] = ToolBox::getMessagesAlerte();
                    header("Location: ".URL."compte/profil");
                    exit();
                }else{
                    ToolBox::ajouterMessageAlerte("La modification a échoué", ToolBox::COULEUR_ROUGE);
                    $_SESSION['messages'] = ToolBox::getMessagesAlerte();
                    header("Location: ".URL."compte/modificationPassword");
                    exit();
                }
            }else{
                ToolBox::ajouterMessageAlerte("La combinaison login/ancien password ne correspond pas",ToolBox::COULEUR_ROUGE);
                header("Location: ".URL."compte/modificationPassword");
            }
        }else{
            ToolBox::ajouterMessageAlerte("Les passwords ne correspondent pas", ToolBox::COULEUR_ROUGE);
            header("Location: ".URL."compte/modificationPassword");
        }
    }


    public function validation_mailCompte($login,$clef){
        if($this->utilisateurManager->bdValidationMailCompte($login,$clef)){
            ToolBox::ajouterMessageAlerte("Le compte est activé !",ToolBox::COULEUR_VERTE);
            $_SESSION['profil']=[
                "login"=>$login,
            ];
            header('Location: '.URL.'compte/profil');
        }else  {
            ToolBox::ajouterMessageAlerte("Le compte n'a pas été activé! ", Toolbox::COULEUR_ROUGE);
            header('Location: '.URL.'creerCompte');
        }
    }


    public function validation_creerCompte($login,$password,$mail){
        if ($this->utilisateurManager->verifLoginDisponible($login)){
            $passwordCrypte=password_hash($password,PASSWORD_DEFAULT);
            $clef = rand(0,9999);
            if($this->utilisateurManager->bdCreerCompte($login,$passwordCrypte,$mail,$clef,"profils/profil.png","utilisateur")){
                $this->sendMailValidation($login,$mail,$clef);
                ToolBox::ajouterMessageAlerte("Le compte a été crée, un mail de validation vous a été envoyé !",ToolBox::COULEUR_VERTE);
                header("Location: ".URL."creerCompte");
            }
        }else{
            ToolBox::ajouterMessageAlerte("Le login est déjà utilisé !", ToolBox::COULEUR_ROUGE);
            header("Location: ".URL."creerCompte");
        }
    }

    private function sendMailValidation($login,$mail,$clef){
        $urlVerification = URL."validationMail/".$login."/".$clef;
        $sujet ="Création du compte pour le site";
        $message=" Pour valider votre compte veuillez cliquer sur le lien suivant ".$urlVerification;
        ToolBox::ajouterMessageAlerte($urlVerification,ToolBox::COULEUR_ORANGE);
        ToolBox::sendMail($mail,$sujet,$message);
    }


    public function suppressionCompte(){
        if($this->utilisateurManager->bdSuppressionCompte($_SESSION['profil']['login'])){
            ToolBox::ajouterMessageAlerte("La suppression du compte est effectué", ToolBox::COULEUR_VERTE);
            $this->deconnexion();
        }else{
            ToolBox::ajouterMessageAlerte("La suppression n'a pas été effectué. Conctactez l'administrateur", ToolBox::COULEUR_ROUGE);
            header("Location: ".URL."compte/profil");
        }
    }


    public function validation_modificationImage($file){
        try{
            $repertoire = "public/assets/images/profils/".$_SESSION['profil']['login']."/";
            $nomImage= ToolBox::ajoutImage($file,$repertoire);//ajout image dans le répertoire
            $this->dossierSuppressionImageUtilisateur($_SESSION['profil']['login']);
            //Suppression de l'ancienne image
            $ancienneImage=$this->utilisateurManager->getImageUtilisateur($_SESSION['profil']['login']);
            if($ancienneImage !=="profils/profil.png"){
                unlink("public/assets/images/".$ancienneImage);
            }
            //Ajout de la nouvelle image dans la BD
            $nomImageBD="profils/".$_SESSION['profil']['login']."/".$nomImage;
            if($this->utilisateurManager->bdAjoutImage($_SESSION['profil']['login'],$nomImageBD)){
                ToolBox::ajouterMessageAlerte("La modification de l'image est effectué",ToolBox::COULEUR_VERTE);
            }else{
                ToolBox::ajouterMessageAlerte("La modification de l'image n'a pas été effectué",ToolBox::COULEUR_ROUGE);
            }
        }catch(Exception $e){
            ToolBox::ajouterMessageAlerte($e->getMessage(), ToolBox::COULEUR_ROUGE);
        }

        header("Location: ".URL."compte/profil");
    }


    
    public function dossierSuppressionImageUtilisateur($login){
        $ancienneImage = $this->utilisateurManager->getImageUtilisateur($_SESSION['profil']['login']);
        if($ancienneImage !== "profils/profil.png"){
            unlink("public/assets/images/".$ancienneImage);
        }
    }


    

    



}

?>