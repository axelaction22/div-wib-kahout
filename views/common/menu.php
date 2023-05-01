
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Kapoot</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?= URL; ?>accueil">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <?php if (!Securite::estConnecte()) : ?>
      <li class="nav-item">
        <a class="nav-link "aria-current="page" href="<?= URL;?>login">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link "aria-current="page" href="<?= URL;?>creerCompte">Creer un Compte</a>
      </li>
      <?php else :?>
        <li class="nav-item">
        <a class="nav-link "aria-current="page" href="<?= URL;?>compte/profil">Profil</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="<?= URL;?>compte/decouverteQuizz">Quizz</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?= URL;?>compte/deconnexion">Se déconnecter</a>
        </li>
      <?php endif;?>
      <?php if(Securite::estConnecte() && Securite::estProfesseur()) :?>
      <li class="nav-item dropdown">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mes Quizz</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?= URL; ?>administration/droits"> Créer un Quizz</a>
              </div>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?= URL; ?>administration/droits"> Voir mes Quizz</a>
              </div>
          </li>    
      </li>
      <?php  endif ?>
      <?php if(Securite::estConnecte() && Securite::estAdministrateur()) :?>
      <li class="nav-item dropdown">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administration</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?= URL; ?>administration/droits"> Gérer les droits</a>
              </div>
          </li>    
      </li>
      <?php  endif ?>
    </ul>
  </div>
</nav>