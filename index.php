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
           default : throw new Exception("la page n'existe pas");
        }
    }catch(Exception $e){
        $visiteurController->pageErreur($e->getMessage());
    }


