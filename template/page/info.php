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

    <div class="card">
        <div class="card-header text-center">
            <span>Kurz-URL Informationen</span>
        </div>
        <div class="card-body">

        </div>
    </div>
</div>

<script src="<?= $requestedPath ?>/asset/js/bootstrap.bundle.min.js"></script>

</body>
</html>