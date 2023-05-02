<h1>Page découverte Quizz</h1>
<div class="container">
    <div class="row">
        <?php foreach ($quizz as $quizz): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?=$quizz['nomQuizz']?> </h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                        <a href="compte/repondreQuizz/<?=$quizz['id_quizz']?>" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>