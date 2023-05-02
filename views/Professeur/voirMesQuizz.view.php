<h1>Page découverte Quizz</h1>
<link  rel="stylesheet" href="<?=URL?>public/CSS/voirmesquizz.css"></link>
<div class="container">
    <div class="row">
        <?php foreach ($quizz as $quizz): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?=$quizz['nomQuizz']?> </h5>
                        <p class="card-text"><?=$quizz['description']?></p>
                        <a href="editQuizz/<?=$quizz['id_quizz']?>" class="btn btn-primary">Edit Quizz</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>