<h1>Création de compte</h1>
<form method="POST" action="validation_creerCompte">
  <div class="form-group">
    <label for="login" class="form-label">Login</label>
    <input type="text" class="form-control" id="login" name="login" placeholder="login" required>
  </div>
  <div class="form-group">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
  </div>
  <div class="form-group">
    <label for="mail" class="form-label">mail</label>
    <input type="mail" class="form-control" id="mail" name="mail" placeholder="mail" required>
  </div>

  <button type="submit" class="btn btn-primary">Créer !</button>
</form>