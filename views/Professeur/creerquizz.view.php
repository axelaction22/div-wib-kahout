<h1>Création de quizz</h1>



<form method="POST" action="validation_creerQuizz">

  <div class= form-group>
    <label for="matiere" class="form-label">Matiere</label>
    <select class="form-control" id="matiere" name="matiere">
    <?php foreach ($matieres as $matiere) : ?>
      <option value="<?= $matiere['nom_matiere']?>"> <?= $matiere['nom_matiere']?> </option>
    <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group bg-black">
    <label for="nom-quizz" class="form-label">Nom du Quizz</label>
    <input type="text" class="form-control" id="nom-quizz" name="nom-quizz" required>
  </div>
  <div class="form-group">
    <label for="description" class="form-label">description</label>
    <input type="text" class="form-control" id="desc" name="desc" placeholder="description du quizz" required>
  </div>
  <div class="form-group">
    <label for="diplome" class="form-label">diplome</label>
    <input type="text" class="form-control" id="diplome" name="diplome" placeholder="diplome" required>
  </div>


  <button type="submit" class="btn btn-primary">Créer !</button>
</form>

