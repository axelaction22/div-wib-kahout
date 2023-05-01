<h1>Création de compte</h1>
<link rel="stylesheet" href="public/CSS/creercompte.css"></link>
<form method="POST" action="validation_creerCompte">
  <div class="form-group bg-black">
    <label for="Login" class="form-label">Login</label>
    <input type="text" class="form-control" id="login" name="login" placeholder="Login" required>
  </div>
  <div class="form-group style=background-color:#222d32;">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
  </div>
  <div class="form-group style=background-color:#222d32;">
    <label for="mail" class="form-label">Mail</label>
    <input type="mail" class="form-control" id="mail" name="mail" placeholder="Mail" required>
  </div>
  <div class="form-group">
  <label for="role" class="form-label">Role</label>
  <select class="form-control" id="role" name="role">
    <option value="utilisateur">Utilisateur</option>
    <option value="professeur">Professeur</option>
  </select>
</div>


  <button type="submit" class="btn btn-primary">Créer !</button>
</form>


