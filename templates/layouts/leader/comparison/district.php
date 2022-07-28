<div class="comparison">

    <div class="block-box block-title-box break-title-dropdown">
        <h3>Сравнение показателей по Региону</h3>

<!--        <div class="dropdown interactive rounded right dark chevron">-->
<!--            <div class="current button button-dropdown rounded"><span class="title">Сравнение:</span> за предыдущий год</div>-->
<!---->
<!--            <div class="options">-->
<!--                <a class="option">за предыдущий год</a>-->
<!--            </div>-->
<!--        </div>-->
    </div>

    <div class="block-box block-title-box sub-block-margin-top">
        <h3>Общие показатели</h3>
    </div>

    <div class="comparison__info">

        <?php foreach ($marks as $mark) { ?>

            <?php
                $type = ' chevron';

                if ($mark['type'] == 'description') {
                    $type = ' muted';
                } elseif ($mark['type'] == 'subparagraph') {
                    $type = ' sub-collapsible chevron';
                }

                if (isset($_GET['district'])) {
                    $slug = $_GET['district'];
                } else {
                    $slug = $_GET['center'];
                }
            ?>

            <div data-mark="<?= $mark['num'] ?>" data-district="<?= $slug ?>" class="collapse-indicator district<?=$type;?>">

                <div class="collapse-indicator-button block-background">
                    <?= (str_contains($mark['num'],'_SV')) ? str_replace('_SV', '', $mark['num']) . ' (сводный)' : $mark['num'] ?>. <?=$mark['name'];?>
                </div>

                <div class="collapse-indicator-content">
                    <div class="line-diagram-block">

                        <div class="block-box block-title-box sub-block-margin-top">
                            <h3>Статистика по показателю</h3>
                            <a id="districtsMap" class="custom-anchor"></a>
                        </div>

                        <div class="rating sub-block-margin-top">

                            <div class="rating__regions block-box sub-block-margin-right">
                                <ul></ul>
                            </div>

                            <div class="rating__info">

                                <div class="block-box block-title-box">
                                    <h3>Показатель <?= (str_contains($mark['num'],'_SV')) ? str_replace('_SV', '', $mark['num']) . ' (сводный)' : $mark['num'] ?></h3>

                                    <a id="districtsRating" class="custom-anchor"></a>

<!--                                    <div class="dropdown interactive rounded right dark chevron">-->
<!--                                        <div class="current button button-dropdown rounded">--><?php //if (isset($_GET['ratingYear'])) { ?><!----><?//= $_GET['ratingYear'] ?><!----><?php //} else { ?><!--2020--><?php //} ?><!--</div>-->
<!---->
<!--                                        <div class="options">-->
<!--                                            <span class="option">2020</span>-->
<!--                                        </div>-->
<!--                                    </div>-->

                                </div>

                                <div class="rating__diagram block-box sub-block-margin-top">

                                    <div class="rating__bars-diagram district-bar-chart">
                                        <canvas></canvas>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="block-box block-title-box sub-block-margin-top">
                            <h3>График показателя</h3>
                        </div>

                        <div class="block-box sub-block-margin-top sub-block-margin-bottom block-padding district-line-chart">
                            <canvas style="max-height: 500px"></canvas>
                        </div>
                    </div>
                </div>

            </div>

        <?php } ?>

    </div>

</div>
