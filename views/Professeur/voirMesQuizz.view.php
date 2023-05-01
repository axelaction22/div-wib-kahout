<div class="container">
    <div class="row">
        <?php foreach ($quizz['nomQuizz'] as $quizze): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img class="card-img-top" src="https://via.placeholder.com/150" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><? echo $quizze?></h5>
                        <p class="card-text">  </p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>