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

<!--            <div class="dropdown interactive rounded right dark chevron">-->
<!--                <div class="current button button-dropdown rounded">--><?php //if (isset($_GET['ratingYear'])) { ?><!----><?//= $_GET['ratingYear'] ?><!----><?php //} else { ?><!--2020--><?php //} ?><!--</div>-->
<!---->
<!--                <div class="options">-->
<!--                    <a class="option" href="?ratingYear=2020#districtsRating">2020</a>-->
<!--                    <a class="option" href="?ratingYear=2019#districtsRating">2019</a>-->
<!--                </div>-->
<!--            </div>-->

        </div>

        <div class="rating__diagram block-box sub-block-margin-top">
            <canvas id="overallRating" style="max-height: 420px"></canvas>
        </div>

    </div>

</div>
