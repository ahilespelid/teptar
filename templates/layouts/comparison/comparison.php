<?php
require_once 'config/Db.php';
$Connect = new Db;
?>

<div class="comparison">

    <div class="block-box block-title-box break-title-dropdown">
        <h3>Сравнение показателей по Региону</h3>

        <div class="dropdown interactive rounded right dark chevron">
            <div class="current button button-dropdown rounded"><span class="title">Сравнение:</span> за предыдущий год</div>

            <div class="options">
                <a class="option">за предыдущий год</a>
            </div>
        </div>
    </div>

    <div class="block-box block-title-box sub-block-margin-top">
        <h3>Общие показатели</h3>
    </div>

    <div class="comparison__info">

        <?php
        /*/ Получение ВСЕХ строк из таблицы. ВООБЩЕ ВСЕХ. $Connect->getAll($sql)/*/
        $sql = 'SELECT * FROM marks';
        foreach($Connect->getAll($sql) as $indicator) {

            $type = ' chevron';

            if ($indicator['type'] == 'description') {
                $type = ' muted';
            } elseif ($indicator['type'] == 'subparagraph') {
                $type = ' sub-collapsible chevron';
            }

            $indexesSql = 'SELECT `index`, district FROM indexes WHERE mark=' . $indicator['num'] . ' ORDER BY `index` DESC';
            $indexes = $Connect->getAll($indexesSql);


            ?>

            <div class="collapse-indicator<?=$type;?>">
                <div class="collapse-indicator-button block-background"><?=$indicator['num'];?>. <?=$indicator['name'];?></div>
                <?php if ($indicator['type'] != 'description') { ?>
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

                                        <tbody>

                                            <?php foreach ($indexes as $index) { ?>

                                                <tr>
                                                    <td><?= $index['district'] ?></td>
                                                    <td>
                                                        <div class="table-avatar" style="background-image: url('/assets/images/avatar3.jpeg')"></div>
                                                        Хасан Шали
                                                    </td>
                                                    <td>
                                                        <div class="table-progress-bar" style="width: <?= round((float)$index['index'] * 100) ?>%">
                                                            <div class="table-progress-bar-gradient"></div>
                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php } ?>

                                        </tbody>
                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>
                <?php } ?>
            </div>

        <?php } ?>

    </div>

</div>

<div class="districts-score" style="display: none">
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

                <tbody>

                    <tr>
                        <td>Надтеречный</td>
                        <td>
                            <div class="table-avatar" style="background-image: url('/assets/images/avatar3.jpeg')"></div>
                            Хасан Шали
                        </td>
                        <td>
                            <div class="table-progress-bar" style="width: 96.8%">
                                <div class="table-progress-bar-gradient"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Аргун</td>
                        <td>
                            <div class="table-avatar" style="background-image: url('/assets/images/avatar2.jpeg')"></div>
                            Усман Аргун
                        </td>
                        <td>
                            <div class="table-progress-bar" style="width: 91.7%">
                                <div class="table-progress-bar-gradient"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Грозный</td>
                        <td>
                            <div class="table-avatar" style="background-image: url('/assets/images/avatar.jpg')"></div>
                            Ибрагим Грозный
                        </td>
                        <td>
                            <div class="table-progress-bar" style="width: 82.5%">
                                <div class="table-progress-bar-gradient"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Серноводский</td>
                        <td>
                            <div class="table-avatar" style="background-image: url('/assets/images/avatar3.jpeg')"></div>
                            Хасан Шали
                        </td>
                        <td>
                            <div class="table-progress-bar" style="width: 76.4%">
                                <div class="table-progress-bar-gradient"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Итум-Калинский</td>
                        <td>
                            <div class="table-avatar" style="background-image: url('/assets/images/avatar2.jpeg')"></div>
                            Усман Аргун
                        </td>
                        <td>
                            <div class="table-progress-bar" style="width: 68.5%">
                                <div class="table-progress-bar-gradient"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Гудермесский</td>
                        <td>
                            <div class="table-avatar" style="background-image: url('/assets/images/avatar2.jpeg')"></div>
                            Усман Аргун
                        </td>
                        <td>
                            <div class="table-progress-bar" style="width: 64.1%">
                                <div class="table-progress-bar-gradient"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Грозненский</td>
                        <td>
                            <div class="table-avatar" style="background-image: url('/assets/images/avatar2.jpeg')"></div>
                            Усман Аргун
                        </td>
                        <td>
                            <div class="table-progress-bar" style="width: 60.3%">
                                <div class="table-progress-bar-gradient"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Шалинский</td>
                        <td>
                            <div class="table-avatar" style="background-image: url('/assets/images/avatar3.jpeg')"></div>
                            Хасан Шали
                        </td>
                        <td>
                            <div class="table-progress-bar" style="width: 54.3%">
                                <div class="table-progress-bar-gradient"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Урус-Мартановский</td>
                        <td>
                            <div class="table-avatar" style="background-image: url('/assets/images/avatar5.jpg')"></div>
                            Керим Гудермес
                        </td>
                        <td>
                            <div class="table-progress-bar" style="width: 46.6%">
                                <div class="table-progress-bar-gradient"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Наурский</td>
                        <td>
                            <div class="table-avatar" style="background-image: url('/assets/images/avatar5.jpg')"></div>
                            Керим Гудермес
                        </td>
                        <td>
                            <div class="table-progress-bar" style="width: 41.4%">
                                <div class="table-progress-bar-gradient"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Шатойский</td>
                        <td>
                            <div class="table-avatar" style="background-image: url('/assets/images/avatar.jpg')"></div>
                            Ибрагим Грозный
                        </td>
                        <td>
                            <div class="table-progress-bar" style="width: 37.1%">
                                <div class="table-progress-bar-gradient"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Шаройский</td>
                        <td>
                            <div class="table-avatar" style="background-image: url('/assets/images/avatar3.jpeg')"></div>
                            Хасан Шали
                        </td>
                        <td>
                            <div class="table-progress-bar" style="width: 32.8%">
                                <div class="table-progress-bar-gradient"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Веденский</td>
                        <td>
                            <div class="table-avatar" style="background-image: url('/assets/images/avatar4.jpg')"></div>
                            Ахмед Шатой
                        </td>
                        <td>
                            <div class="table-progress-bar" style="width: 28.4%">
                                <div class="table-progress-bar-gradient"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Шелковской</td>
                        <td>
                            <div class="table-avatar" style="background-image: url('/assets/images/avatar.jpg')"></div>
                            Ибрагим Грозный
                        </td>
                        <td>
                            <div class="table-progress-bar" style="width: 23.1%">
                                <div class="table-progress-bar-gradient"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Ножай-Юртовский</td>
                        <td>
                            <div class="table-avatar" style="background-image: url('/assets/images/avatar5.jpg')"></div>
                            Керим Гудермес
                        </td>
                        <td>
                            <div class="table-progress-bar" style="width: 17.9%">
                                <div class="table-progress-bar-gradient"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Ачхой-Мартановский</td>
                        <td>
                            <div class="table-avatar" style="background-image: url('/assets/images/avatar4.jpg')"></div>
                            Ахмед Шатой
                        </td>
                        <td>
                            <div class="table-progress-bar" style="width: 14.4%">
                                <div class="table-progress-bar-gradient"></div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Курчалоевский</td>
                        <td>
                            <div class="table-avatar" style="background-image: url('/assets/images/avatar4.jpg')"></div>
                            Ахмед Шатой
                        </td>
                        <td>
                            <div class="table-progress-bar" style="width: 12.4%">
                                <div class="table-progress-bar-gradient"></div>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>

        </div>

    </div>

</div>

<!--<script>-->
<!--    // Временная мера для дублирования таблиц во всех развернутых показателях-->
<!--    let collapsibleContent = document.querySelectorAll('.temp-content .collapsible-content');-->
<!--    collapsibleContent.forEach((content) => {-->
<!--        let clone = document.querySelector('.districts-score').cloneNode(true);-->
<!--        clone.style.display = 'block';-->
<!--        content.appendChild(clone);-->
<!--    })-->
<!--</script>-->
