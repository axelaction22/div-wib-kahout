<?php 
//accueil

//page de login
session_start();
define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS'])? "https":"http")."://".$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"]));


require_once("./controllers/Securite.class.php");
require_once("./controllers/Toolbox.class.php");
require_once("./controllers/Visiteur/Visiteur.controller.php");
require_once("./controllers/Utilisateur/Utilisateur.controller.php");
require_once("./controllers/Administrateur/Administrateur.controller.php");



$visiteurController=new VisiteurController();
$utilisateurController=new UtilisateurController();
$administrateurController=new AdministrateurController();



if(empty($_GET['page'])){
    $page="accueil";
}else{
    $url= explode("/",filter_var($_GET['page'],FILTER_SANITIZE_URL));
    $page = $url[0];
}
try{
    switch($page){
        case "accueil" :
           $visiteurController->accueil();
           break;
        case "login" :
            $visiteurController->login();
            break;
        case "validation_login":
            if(!empty($_POST['login']) && !empty($_POST['password'])){
                $login = Securite::secureHTML($_POST['login']);
                $password = Securite::secureHTML($_POST['password']);
                $utilisateurController->validation_login($login,$password);
                
            }else{
                ToolBox::ajouterMessageAlerte("Login ou mot de Passe non renseigné", ToolBox::COULEUR_ROUGE);
                header('Location: '.URL."login");
            }
        break;
        case "compte":
            if(!Securite::estConnecte()){
                ToolBox::ajouterMessageAlerte("Veuillez vous connecter !", ToolBox::COULEUR_ROUGE);
                header("Location: ".URL."login");
            }else{
                switch($url[1]){
                    case "profil": $utilisateurController->profil();
                    break;
                    case "deconnexion":$utilisateurController->deconnexion();
                    break;
                    case "validation_modificationMail" : $utilisateurController->validation_modificationMail(Securite::secureHTML($_POST['mail']));
                    break;
                    case "modificationPassword" : $utilisateurController->modificationPassword();
                    break;
                    case "validation_modificationPassword":
                        if(!empty($_POST["ancienPassword"]) && !empty($_POST['nouveauPassword']) && !empty($_POST['confirmNouveauPassword'])){
                            $ancientPassword = Securite::secureHTML($_POST['ancienPassword']);
                            $nouveauPassword = Securite::secureHTML($_POST['nouveauPassword']);
                            $confirmationNouveauPassword = Securite::secureHTML($_POST['confirmNouveauPassword']);
                            $utilisateurController->validation_modificationPassword($ancientPassword,$nouveauPassword,$confirmationNouveauPassword);
                        }else{
                            ToolBox::ajouterMessageAlerte("Vous n'avez pas renseigné toutes les informations", ToolBox::COULEUR_ROUGE);
                            header("Location: ".URL."compte/modificationPassword");
                        }
                        break;
                    default : throw new Exception("la page n'existe pas");
                    
                }
            }
           default : throw new Exception("la page n'existe pas");
        }
    }catch(Exception $e){
        $visiteurController->pageErreur($e->getMessage());
    }


