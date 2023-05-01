<h1>Edit le quizz - <?=$_SESSION['profil']['login'] ?></h1>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form>
                <div class="form-group">
                    <label for="type-quizz">Type de quizz :</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type-quizz" id="type-quizz1" value="1" checked>
                        <label class="form-check-label" for="type-quizz1">
                            Type 1 - Énoncé et réponse en string
                        </label>
                        <div id="type-quizz1-fields">
                            <div class="form-group">
                                <label for="enonce-quizz1">Énoncé :</label>
                                <input type="text" class="form-control" id="enonce-quizz1" name="enonce-quizz1">
                            </div>
                            <div class="form-group">
                                <label for="reponse-quizz1">Réponse :</label>
                                <input type="text" class="form-control" id="reponse-quizz1" name="reponse-quizz1">
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type-quizz" id="type-quizz2" value="2">
                        <label class="form-check-label" for="type-quizz2">
                            Type 2 - Énoncé et choix multiples de réponses
                        </label>
                        <div id="type-quizz2-fields" style="display:none;">
                            <div class="form-group">
                                <label for="enonce-quizz2">Énoncé :</label>
                                <input type="text" class="form-control" id="enonce-quizz2" name="enonce-quizz2">
                            </div>
                            <div class="form-group">
                                <label for="reponse-quizz2-1">Réponse 1 :</label>
                                <input type="text" class="form-control" id="reponse-quizz2-1" name="reponse-quizz2-1">
                            </div>
                            <div class="form-group">
                                <label for="reponse-quizz2-2">Réponse 2 :</label>
                                <input type="text" class="form-control" id="reponse-quizz2-2" name="reponse-quizz2-2">
                            </div>
                            <div class="form-group">
                                <label for="reponse-quizz2-3">Réponse 3 :</label>
                                <input type="text" class="form-control" id="reponse-quizz2-3" name="reponse-quizz2-3">
                            </div>
                        </div>
                    </div>