<h1>Page de gestion des droits</h1>
<table class ="table">
    <thread>
        <tr>
            <th>Login</th>
            <th>Validé</th>
            <th>Rôle</th>
        </tr>
        <?php foreach ($utilisateurs as $utilisateur):?>
            <tr>
                <td><?=$utilisateur['login']?></td>
                <td><?=(int)$utilisateur['est_valide']===0 ?"non validé":"validé" ?></td>
                <td>
                    <?php if ($utilisateur['role'] === "administrateur"): ?>
                        <?= $utilisateur['role'] ?>
                    <?php else: ?>
                        <form methods="POST" action="<?URL ?>administration/validation_modificationRole">
                            <input type="hidden" name="login" value="<?=$utilisateur["login"] ?>" />
                            <select class="form-selcet" name="role" onchange="confirm('confirmez vous la modification ?') ? submit() : document.location.reload()">
                                <option value="utilisateur" <?= $utilisateur['role']==="utilisateur" ? "selected" : ""?>>Utilisateur</option>
                                <option value="Sutilisateur" <?= $utilisateur['role']==="Sutilisateur" ? "selected" : ""?>>Super Utilisateur</option>
                                <option value="administrateur" <?= $utilisateur['role']==="administrateur" ? "selected" : ""?>>Administrateur</option>
                            </select>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </thread>
</table> 