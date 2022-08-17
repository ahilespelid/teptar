<div class="rating">

    <div class="rating__regions block-box sub-block-margin-right">
        <ul>
            <?php foreach ($ratings as $key => $rating) { ?>
                <li><b><?= $key + 1 ?>.</b> <?= $rating['owner'] ?></li>
            <?php } ?>
        </ul>
    </div>

    <div class="rating__info">

        <div class="block-box block-title-box">
            <h3>Общий рейтинг</h3>

            <a id="districtsRating" class="custom-anchor"></a>

            <div class="dropdown interactive rounded right dark chevron" id="districtsGeneralRatingToggle">
                <div class="current button button-dropdown rounded"><?= (new DateTime('-1 year'))->format('Y') ?></div>

                <?php $first = 2020 ?>
                <?php $last = (int)(new DateTime('-1 year'))->format('Y') ?>

                <div class="options">
                    <?php for ($i = 0; $i <= $last - $first; $i++) { ?>
                        <span class="option"><?= $first + $i ?></span>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="rating__diagram block-box sub-block-margin-top">
            <canvas id="overallRating" style="max-height: 420px"></canvas>
        </div>

    </div>

</div>
