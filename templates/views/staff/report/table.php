<?php include $this->layout('staff/base/head.php'); ?>

    <body>

        <?php include $this->layout('staff/menu.php'); ?>

        <div class="content">

            <?php include $this->layout('staff/header.php'); ?>

            <div class="body report-table">
                <div class="body__back-button">
                    <a href="/report?id=<?= $report['id'] ?>">
                        <span class="icon-expand_left_right body__back__arrow"></span>
                        Вернуться
                    </a>
                    <div class="body__back-button__tables">
                        <a href="/report/sv-table?report=<?= $report['id'] ?>" class="finished__table">
                            <span class="icon-archive"></span>
                            Общая таблица
                        </a>
                        <a href="/report/sv-table?report=<?= $report['id'] ?>" class="pivot__table">
                            <span class="icon-save_light"></span>
                            Сводная таблица
                        </a>
                    </div>
                </div>

                <div class="reports-title">
                    <div class="reports-title__my-reports">
                        <div class="reports-title__my-reports__text">
                            <h1>Общая таблица</h1>
                            <span class="title">(Район: <?= $uin['owner'] ?>)</span>
                        </div>
                        <div class="reports-title__my-reports__btn">
                        </div>
                    </div>
                </div>

                <div class="table tableFixHead">
                    <table class="table__main">
                        <thead class="table__main__header">
                            <tr>
                                <th>#</th>
                                <th id="description__title">Показатели</th>
                                <th id="unit__title">Ед. измерения</th>
                                <?php foreach ($years as $year) { ?>
                                    <th class="years"><?= $year ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $entry) { ?>
                                <tr>
                                    <td class="number"><?= $entry['mark'] ?></td>
                                    <?php if ($entry['type'] == 'description') { ?>
                                        <td class="description" colspan="<?= count($years) + 2 ?>"><?= $entry['description'] ?></td>
                                    <?php } else { ?>
                                        <td class="description"><?= $entry['description'] ?></td>
                                        <td class="unit"><?= $entry['unit'] ?></td>
                                        <?php foreach ($years as $year) { ?>
                                            <td class="years"><?= (isset($entry[$year][0])) ? $entry[$year][0]['index'] : '' ?></td>
                                        <?php } ?>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
