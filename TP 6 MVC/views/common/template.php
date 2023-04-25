<!doctype html>
<html lang="en">
  <head>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= $page_description; ?>">

    <title><?=$page_title; ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
         
    <!-- intégration d'une feuille de styles main.css pour les styles personalisés sur toutes les pages -->
      <link href="<?= URL ?>public/CSS/main.css" rel="stylesheet"/>

    <!--test pour savoir si nous intégrons ou non une feuille de style personnalisé suivant la page -->
      <?php if(!empty($page_css)) : ?>
        <link href="<?= URL ?>public/CSS/<?= $page_css ?>" rel ="stylesheet" />
      <?php endif;?>
      
  </head>
  <body>
  


  <!-- Insertion du header -->
  <?php require_once("views/common/header.php"); ?>

  <!--Création de notre Session pour gérer notre alerte -->
  <div class="container">
    <?php 
      if (!empty($_SESSION['alert'])) {
       foreach($_SESSION['alert'] as $alert){
          echo "<div class='alert ".$alert['type'] ."' role='alert'>".$alert['message']."</div>";
        }
        unset($_SESSION['alert']);
      }
    ?>
  </div>
  
  <!-- Contenu de la page dans un container -->
  <section class="container">
    <?php if (empty($page_content)){
      echo "Pas de contenu";
    }else{
      echo $page_content;
    } ?>
  </section>

    <!--Insertion du footer -->
    <?php require_once("views/common/footer.php"); ?> 
      
      
    <!-- Optional JavaScript -->
    <!--- test pour savoir si le fichier javascipt existe et si oui, il est inclu -->
    <?php if(!empty($page_javascript)) :?>
      <?php foreach($page_javascript as $fichier_javascript): ?>
        <script src="<?= URL ?>public/JavaScript/<?=$fichier_javascript ?>"></script>
      <?php endforeach; ?>
    <?php endif; ?>


    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    

  
  </body>
</html>