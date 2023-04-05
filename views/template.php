<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content=<?= $page_description ?>>
    <title><?= $page_title?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

    <body>
        <?php require_once("menu.php");?>
        <?= $page_content ?>
        <?php require_once("inscription.html");?>
        

    <script src="../js\jquery-3.6.4.min.js"></script>
    <script src="../js\popper.min.js"></script>
    <script src="../js\bootstrap.bundle.min.js"></script>
    </body>

</html>

   