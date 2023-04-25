<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto text-right">
      <li class="nav-item active">
        <a class="nav-link" href="<?= URL; ?>accueil">Accueil<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= URL; ?>page1">page1</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Liste déroulante
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?= URL; ?>compte/profil">page2</a>
          <a class="dropdown-item" href="<?= URL; ?>page3">page3</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
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
          <a class="nav-link" aria-current="page" href="<?= URL;?>compte/deconnexion">Se déconnecter</a>
        </li>
      <?php endif;?>
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

