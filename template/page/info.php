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

    <div class="card mb-3">
        <div class="card-header text-center">
            <span>Kurz-URL Informationen</span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <span><strong>Link ID:</strong> <?= $data['link_id']; ?></span> <br>
                    <span><strong>Shortcode:</strong> <?= $shortRequested ?></span> <br>
                    <span><strong>Weiterleitung auf:</strong> <a href="<?= $data['link_redirect'] ?>"><?= $data['link_redirect'] ?></a></span> <br>
                    <span><strong>Erstellt am:</strong> <?= date('d.m.Y H:i', $data['link_created']) ?></span> <br>
                    <span><strong>Ablauf:</strong> <?= $expires ?></span> <br>
                </div>
                <div class="col-md-6">
                    <span><strong>Zugriffe:</strong> <?= $uses ?></span>
                    <hr>
                    <h5>Useragents (letzte 15 Zugriffe)</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Useragent</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?= $accessList ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="text-start">
        <a href="/<?= $requestedPath ?>">&leftleftarrows; Zur Hautpseite</a>
    </div>
</div>

<script src="<?= $requestedPath ?>/asset/js/bootstrap.bundle.min.js"></script>

</body>
</html>