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

        <?php $templateEngine->outputAlerts($messages) ?>

        <div class="card">
            <div class="card-header text-center">
                <span>Neue Kurz-URL anlegen</span>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="row">
                        <div class="col-10">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="longUrlInput" placeholder="https://google.com" id="longUrlInput">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="mb-3">
                                <button class="btn btn-dark w-100" type="submit">Kürzen</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="accordion" id="advancedOptionsDropdown">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="shareOptionsHeading">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#shareOptionsTab" aria-controls="shareOptionsTab">
                                            Freigabe Optionen
                                        </button>
                                    </h2>
                                    <div id="shareOptionsTab" class="accordion-collapse collapse show" aria-labelledby="shareOptionsHeading" data-bs-parent="#shareOptionsDropdown">
                                        <div class="accordion-body">
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="advancedOptionsHeading">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                            Weitere Optionen
                                        </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= $requestedPath ?>/asset/js/bootstrap.bundle.min.js"></script>

</body>
</html>