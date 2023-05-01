<h1>Page de gestion des droits des utilisateurs</h1>
<link rel="stylesheet" href="<?= URL ?>public/CSS/droits.css"></link>
<table class="table">
    <thead>
        <tr>
            <th>Login</th>
            <th>Validé</th>
            <th>Rôle</th>
        </tr>
        <?php foreach ($utilisateurs as $utilisateur) : ?>
            <tr>
                <td><?= $utilisateur['login'] ?></td>
                <td><?= (int)$utilisateur['est_valide'] === 0 ? "non validé" : "validé" ?></td>
                <td>
                    <?php if ($utilisateur['role'] === "administrateur") : ?>
                        <?= $utilisateur['role'] ?>
                    <?php else : ?>
                        <form method="POST" action="<?= URL; ?>administration/validation_modificationRole">
                            <input type="hidden" name="login" value="<?= $utilisateur['login']; ?>" />
                            <select name="role" onchange="confirm('confirmez-vous la modification?') ? submit() : document.location.reload()" class="form-select">
                                <option value="utilisateur" <?= $utilisateur['role'] === "utilisateur" ? "selected" : "" ?>>Utilisateur</option>
                                <option value="professeur" <?= $utilisateur['role'] === "professeur" ? "selected" : "" ?>>Professeur</option>
                                <option value="administrateur" <?= $utilisateur['role'] === "administrateur" ? "selected" : "" ?>>Administrateur</option>
                            </select>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </thead>
</table>