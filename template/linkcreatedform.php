<div class="col-md-3">
    <div class="card">
        <div class="card-header text-center">
            URL Informationen
        </div>
        <div class="card-body text-center">
            <?php if(isset($base64Image)):?>
            <img src="<?= $base64Image ?>" class="rounded mx-auto d-block">
            <hr>
            <?php endif; ?>
            <b>Linkadresse: </b> <a href="<?= $linkUrl ?>"><?= $linkUrl ?></a> <hr>
            <b>Telemetrie: </b> <a href="<?= $linkUrl ?>/info"><?= $linkUrl ?>/info</a> <hr>
            <b>Zieladresse: </b> <a href="<?= $destinationUrl ?>"><?= $destinationUrl ?></a> <hr>
            <b>Max. Nutzungen: </b> <?= $linkMaxuse ?> <hr>
            <b>Ablauf:</b> <?= $linkExpiry ?>
        </div>
    </div>
</div>