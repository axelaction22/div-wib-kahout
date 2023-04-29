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
                    default : throw new Exception("la page n'existe pas");
                    
                }
            }
           default : throw new Exception("la page n'existe pas");
        }
    }catch(Exception $e){
        $visiteurController->pageErreur($e->getMessage());
    }


