<h1>Edit le quizz - <?=$_SESSION['profil']['login'] ?></h1>


<hr>
<form>
  <div>
    <h4>Choisissez le type de question à ajouter</h4>
    <hr>
    <div>
    <label>
      <input type="radio" name="type" value="1" checked> Question ouverte
    </label>
    </div>
    <div>
    <label>
      <input type="radio" name="type" value="2"> Question Fermée
    </label>
    </div>
    <div>
    <label>
      <input type="radio" name="type" value="3"> Question de Code
    </label>
    </div>
    <hr>
  <br>
</form>
<div id="questionOuverte" style="display: block;">
    <h3>Ajouter une question ouverte</h3>
    <form class="form-group" method="POST" action="<?= URL ?>compte/creerQuestionOuverte">
        <div>
            <label for="enonce-texte">Énoncé</label>
            <input type="text" class="form-control" id="enonce-texte" name="enonce-texte" placeholder="Entrez l'énoncé de la question">
        </div>
        <div class="form-group">
            <label for="reponse-texte">Réponse</label>
            <input type="text" class="form-control" id="reponse-texte" name="reponse-texte" placeholder="Entrez la réponse de la question">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter la question</button>
    </form>
</div>



<div id="questionFermee" style="display: none;">

<h3> Ajouter une question fermée </h3>
    <form>
  <div class="form-group" method="POST" action="<?= URL ?>compte/creerQuestion">
    <label for="enonce-multiple">Énoncé</label>
    <input type="text" class="form-control" id="enonce-multiple" placeholder="Entrez l'énoncé du quizz">
  </div>
  <div class="form-group">
    <label for="choix-multiple">Choix</label>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="choix1">
      <label class="form-check-label" for="choix1">
        Choix 1
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="choix2">
      <label class="form-check-label" for="choix2">
        Choix 2
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="choix3">
      <label class="form-check-label" for="choix3">
        Choix 3
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Ajouter la question</button>
</form>
</div>
    

<div id="questionCode" style="display: none;">
    <h4>Pas encore fonctionnel</h4>
</div>


<script>
  var radioButtons = document.getElementsByName('type');
  for (var i = 0; i < radioButtons.length; i++) {
    radioButtons[i].addEventListener('change', function() {
      var divType1 = document.getElementById('questionOuverte');
      var divType2 = document.getElementById('questionFermee');
      var divType3 = document.getElementById('questionCode');
      if (this.value === '1') {
        divType1.style.display = 'block';
        divType2.style.display = 'none';
        divType3.style.display = 'none';
      } else if (this.value === '2') {
        divType1.style.display = 'none';
        divType2.style.display = 'block';
        divType3.style.display = 'none';
      } else if (this.value === '3') {
        divType1.style.display = 'none';
        divType2.style.display = 'none';
        divType3.style.display = 'block';
      }
    });
  }
</script>