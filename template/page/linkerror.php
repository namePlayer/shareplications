<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shareplicaitons</title>
    <link rel="stylesheet" href="<?= $requestedPath ?>/asset/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">

    <?php echo $templateEngine->outputAlerts($messages) ?>

    <div class="alert alert-secondary text-center" role="alert">
        <h4 class="alert-heading">Fehler: <?= $errorTitle ?></h4>
        <p><?= $errorMessage ?></p>
        <hr>
        <p class="mb-0"><b>HTML-Errorcode</b>: <?= $errorCode ?></p>
    </div>

    <div class="text-start">
        <a href="/<?= $requestedPath ?>">&leftleftarrows; Zur Hautpseite</a>
    </div>
</div>

<script src="<?= $requestedPath ?>/asset/js/bootstrap.bundle.min.js"></script>

</body>
</html>