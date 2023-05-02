<?php
//accueil

//page de login
session_start();
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));


require_once("./controllers/Securite.class.php");
require_once("./controllers/Toolbox.class.php");
require_once("./controllers/Visiteur/Visiteur.controller.php");
require_once("./controllers/Utilisateur/Utilisateur.controller.php");
require_once("./controllers/Administrateur/Administrateur.controller.php");
require_once("./controllers/Professeur/prof.controlleur.php");


$visiteurController = new VisiteurController();
$utilisateurController = new UtilisateurController();
$administrateurController = new AdministrateurController();
$professeurController = new profController();


if (empty($_GET['page'])) {
    $page = "accueil";
} else {
    $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
    $page = $url[0];
}
try {
    switch ($page) {
        case "accueil":
            $visiteurController->accueil();
            break;
        case "login":
            $visiteurController->login();
            break;
        case "validation_login":
            if (!empty($_POST['login']) && !empty($_POST['password'])) {
                $login = Securite::secureHTML($_POST['login']);
                $password = Securite::secureHTML($_POST['password']);
                $utilisateurController->validation_login($login, $password);
            } else {
                ToolBox::ajouterMessageAlerte("Login ou mot de Passe non renseigné", ToolBox::COULEUR_ROUGE);
                header('Location: ' . URL . "login");
            }
            break;
        case "compte":
            if (!Securite::estConnecte()) {
                ToolBox::ajouterMessageAlerte("Veuillez vous connecter !", ToolBox::COULEUR_ROUGE);
                header("Location: " . URL . "login");
            } else {
                switch ($url[1]) {
                    case "profil":
                        $utilisateurController->profil();
                        break;
                    case "deconnexion":
                        $utilisateurController->deconnexion();
                        break;
                    case "validation_modificationMail":
                        $utilisateurController->validation_modificationMail(Securite::secureHTML($_POST['mail']));
                        break;
                    case "modificationPassword":
                        $utilisateurController->modificationPassword();
                        break;
                    case "validation_modificationPassword":
                        if (!empty($_POST["ancienPassword"]) && !empty($_POST['nouveauPassword']) && !empty($_POST['confirmNouveauPassword'])) {
                            $ancientPassword = Securite::secureHTML($_POST['ancienPassword']);
                            $nouveauPassword = Securite::secureHTML($_POST['nouveauPassword']);
                            $confirmationNouveauPassword = Securite::secureHTML($_POST['confirmNouveauPassword']);
                            $utilisateurController->validation_modificationPassword($ancientPassword, $nouveauPassword, $confirmationNouveauPassword);
                        } else {
                            ToolBox::ajouterMessageAlerte("Vous n'avez pas renseigné toutes les informations", ToolBox::COULEUR_ROUGE);
                            header("Location: " . URL . "compte/modificationPassword");
                        }
                        break;
                    case "suppressionCompte":
                        $utilisateurController->suppressionCompte();
                        break;
                    case "validation_modificationImage":
                        if ($_FILES['image']['size'] > 0) {
                            $utilisateurController->validation_modificationImage($_FILES['image']);
                        } else {
                            ToolBox::ajouterMessageAlerte("Vous n'avez pas modifié l'image", ToolBox::COULEUR_ROUGE);
                            header("Location: " . URL . "compte/profil");
                        }
                        break;
                    case "decouverteQuizz":
                        $utilisateurController->decouverteQuizz();
                        break;
                    case "creerQuizz":
                        $professeurController->creerQuizz();
                        break;
                    case "validation_creerQuizz":
                        if(strlen($_POST['nom-quizz'])>49){
                            ToolBox::ajouterMessageAlerte("Le nom ne doit pas depasser 50 caracteres",ToolBox::COULEUR_ROUGE);
                            $professeurController->creerQuizz();
                            
                        }else if (strlen($_POST['desc'])>999){
                            ToolBox::ajouterMessageAlerte("La description ne doit pas dépasser 1000 caracteres",ToolBox::COULEUR_ROUGE);
                            $professeurController->creerQuizz();
                            
                        }else if (strlen($_POST['diplome'])>49){
                            ToolBox::ajouterMessageAlerte("La description ne doit pas depasser 50 caracteres",ToolBox::COULEUR_ROUGE);
                            $professeurController->creerQuizz();
                           
                        }
                        break;
                    case "voirMesQuizz":
                        $professeurController->voirMesQuizz();
                        break;
                    case "editQuizz":
                        $professeurController->editQuizz($url[2]);
                        break;
                    case "creerQuestionOuverte":
                        $enonce=Securite::secureHTML($_POST['enonce-texte']);
                        $reponse=Securite::secureHTML($_POST['reponse-texte']);
                        $professeurController->creerQuestion("ouvert","enonce-texte","reponse-texte",2);
                        break;
                    case "repondreQuizz":
                        $utilisateurController->repondreQuizz($url[2]);
                        
                    default:throw new Exception("la page n'existe pas");
                }
            }
            break;
        case "creerCompte":
            $visiteurController->creerCompte();
            break;
            case "validation_creerCompte" : 
                if(!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['mail'])){
                    $login = Securite::secureHTML($_POST['login']);
                    $password =Securite::secureHTML($_POST['password']);
                    $mail = Securite::secureHTML($_POST['mail']);
                    $role = securite::secureHTML($_POST['role']);
                    $utilisateurController->validation_creerCompte($login,$password,$mail,$role);
                }else{
                    ToolBox::ajouterMessageAlerte("Les 3 informations sont obligatoires !",Toolbox::COULEUR_ROUGE);
                    header("Location: ".URL."creerCompte");
                }
            break;
        case "validationMail":
            $utilisateurController->validation_mailCompte($url[1], $url[2]);
            break;
            case "administration" :
                if(!Securite::estConnecte()){
                    ToolBox::ajouterMessageAlerte("Veuillez vous connecter !",ToolBox::COULEUR_ROUGE);
                    header("Location: ".URL."login");
                }else if(!Securite::estAdministrateur()){
                    ToolBox::ajouterMessageAlerte("Vous n'avez pas le droit d'être ici",ToolBox::COULEUR_ROUGE);
                    header("Location: ".URL."accueil");
                }else{
                    switch($url[1]){
                        case "droits": $administrateurController->droits();
                        break;
                        case 'validation_modificationRole' : $administrateurController->validation_modificationRole($_POST['login'], $_POST['role']);
                        break;
                        default : throw new Exception("La page n'existe pas");
                    }
                }
            break;
            

        default : throw new Exception("la page n'existe pas");
        }
    }catch(Exception $e){
        $visiteurController->pageErreur($e->getMessage());

}
