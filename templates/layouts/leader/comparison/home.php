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

            ?>

            <div id="indicator<?= $mark['num'] ?>" class="collapse-indicator general<?= $type ?>">

                <div class="collapse-indicator-button block-background">
                    <?= (str_contains($mark['num'],'_SV')) ? str_replace('_SV', '', $mark['num']) . ' (сводный)' : $mark['num'] ?>. <?=$mark['name'];?>
                </div>

                <div class="collapse-indicator-content">

                    <div class="districts-score">
                        <div class="block-box block-title-box">
                            <h3>Показатель по всем районам</h3>
                        </div>

                        <div class="smooth-border">
                            <div class="scrollable-table">

                                <table class="districts-score-table sortable-table block-background">
                                    <thead>
                                        <tr>
                                            <th>Район <i class="sortable-icon"></i></th>
                                            <th>Глава <i class="sortable-icon"></i></th>
                                            <th>Эффективность <i class="sortable-icon"></i></th>
                                        </tr>
                                    </thead>

                                    <tbody></tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        <?php } ?>

    </div>

</div>
