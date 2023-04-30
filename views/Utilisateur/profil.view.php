<h1>Profil de <?= $utilisateur['login'] ?></h1>
<div>
    <div>
        <img src="<?= URL; ?>public/assets/images/<?= $utilisateur['image'] ?>" width="100px" alt="photo de profil"/>
    </div>
    <div>
        <form method="POST" action="<?= URL;?>compte/validation_modificationImage" enctype="multipart/form-data">
            <div class="row">
                <label for="image"> Changer l'image de profil</label>
                <input type="file" class="form-control-file" name="image" id="image" onchange="submit();"/>
            </div>
        </form>
    </div>
    <br>
    <div id="mail">
        Email:<?= $utilisateur['email']?><br>
        <button class="btn btn-primary" id="btnModifMail">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
        </svg>
        </button>
        <a href="<?= URL ?>compte/modificationPassword" class="btn btn-warning">Changer le mot de passe</a>
        <button id="btnSupCompte" class="btn btn-danger">Supprimer mon compte</button>
    </div>

    <div id="suppressionCompte" class="d-none m-2">
        <div class="alert alert-danger">
            Veuillez confirmer la suppression du compte
            <br>
            <a href="<?= URL ?>compte/suppressionCompte" class="btn btn-danger">Je souhaite supprimer mon compte définitivement !</a>
        </div>
    </div>


    <div id="modificationMail" class="d-none">
        <form method="POST" action="<?= URL;?>compte/validation_modificationMail">
            <div class="row">
                <div class="input-group mb-3">
                    <input type="mail" class="form-control" name="mail" value="<?= $utilisateur['email'] ?>"/>
                    <button  class="btn btn-success" id="btnValidModifMail" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
</div>

</div>



