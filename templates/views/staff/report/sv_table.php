<?php include $this->layout('staff/base/head.php'); ?>

    <body>

        <?php include $this->layout('staff/menu.php'); ?>

        <div class="content">

            <?php include $this->layout('staff/header.php'); ?>

            <div class="body report-table">

                <?php if ($alerts && isset($alerts['errors'])) { ?>
                    <div class="alert alert-error">
                        <ul>
                            <?php foreach ($alerts['errors'] as $mark => $message) { ?>
                                <li>Показатель <?= $mark ?>: <?= $message ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <?php if ($alerts && isset($alerts['successes'])) { ?>
                    <div class="alert alert-success">
                        <ul>
                            <?php foreach ($alerts['successes'] as $mark => $message) { ?>
                                <li>Показатель <?= $mark ?>: <?= $message ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <div class="body__back-button">
                    <a href="#">
                        <span class="icon-expand_left_right body__back__arrow"></span>
                        Вернуться
                    </a>
                    <div class="body__back-button__tables">
                        <a href="" class="finished__table">
                            <span class="icon-archive"></span>
                            Общая таблица
                        </a>
                        <a href="" class="pivot__table">
                            <span class="icon-save_light"></span>
                            Сводная таблица
                        </a>
                    </div>
                </div>

                <div class="reports-title">
                    <div class="reports-title__my-reports">
                        <div class="reports-title__my-reports__text">
                            <h1>Грозный: Таблица 2022</h1>
                        </div>
                        <div class="reports-title__my-reports__btn">
                        </div>
                    </div>
                </div>

                <div class="table">
<!--                    --><?php //pa($_POST) ?>

                    <form method="post" action="">
                        <table>
                            <table>
                                <thead class="table__main__header">
                                    <tr>
                                        <th>Показатель</th>
                                        <th>Описание</th>
                                        <th>Ед. измерения</th>
                                        <th>Район</th>
                                        <th>Ведомство</th>
                                        <?php if ($this->security->userHasRole(['district_boss', 'district_staff'])) { ?>
                                            <th>Действие</th>
                                            <th>Итог</th>
                                        <?php } ?>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($marks as $mark) { ?>
                                        <tr>
                                            <td><?= $mark['num'] ?></td>
                                            <?php if ($mark['type'] != 'description') { ?>
                                                <td><?= $mark['name'] ?></td>
                                                <td><?= $mark['unit'] ?></td>
                                                <td>
                                                    <?php if ($this->security->userHasRole(['district_boss', 'district_staff'])) { ?>
                                                        <label for="districtMark<?= $mark['num'] ?>"></label>
                                                        <input type="text" name="marks[<?= $mark['num'] ?>][district]" <?= (isset($mark['district'])) ? 'value="' . $mark['district'] .  '"' : '' ?> placeholder="Индекс (района: <?= $uin['owner'] ?>)" id="districtMark<?= $mark['num'] ?>">
                                                    <?php } else { ?>
<!--                                                        <input type="text" disabled>-->
                                                        <?= (isset($mark['district'])) ? $mark['district'] : '-' ?>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($this->security->userHasRole(['ministry_boss', 'ministry_staff'])) { ?>
                                                        <label for="ministryMark<?= $mark['num'] ?>"></label>
                                                        <input type="text" name="marks[<?= $mark['num'] ?>][ministry]" <?= (isset($mark['ministry'])) ? 'value="' . $mark['ministry'] .  '"' : '' ?> placeholder="Индекс" id="ministryMark<?= $mark['num'] ?>">
                                                    <?php } else { ?>
                                                        <?= (isset($mark['ministry'])) ? $mark['ministry'] : '-' ?>
                                                    <?php } ?>
                                                </td>
                                                <?php if ($this->security->userHasRole(['district_boss', 'district_staff'])) { ?>
                                                    <td>
                                                        <label for="markActions<?= $mark['num'] ?>"></label>
                                                        <select id="markActions<?= $mark['num'] ?>" name="marks[<?= $mark['num'] ?>][action]" data-placeholder="Выбрать действие">
                                                            <option value="0" selected>Выбрать действие</option>
                                                            <option value="agreed">Согласовано</option>
                                                            <option value="disagreed">Не согласовано</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <label for="districtResult<?= $mark['num'] ?>"></label>
                                                        <input type="text" name="marks[<?= $mark['num'] ?>][result]" placeholder="Итоговый индекс" id="districtResult<?= $mark['num'] ?>">
                                                    </td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <td colspan="6"><?= $mark['name'] ?></td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </table>
                        <input type="submit" class="registration__form__footer__button" value="Сохранить">
                    </form>
                </div>

            </div>
        </div>

        <script>
            // Prevent letters and symbols
            // $('.report-table input').on('keypress', function (event) {
            //     let regex = new RegExp("^[0-9]+$");
            //     let key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            //     if (!regex.test(key)) {
            //         event.preventDefault();
            //         return false;
            //     }
            // });

            function disableEmptyInputs(form) {
                var controls = form.elements;
                for (var i=0, iLen=controls.length; i<iLen; i++) {
                    controls[i].disabled = controls[i].value === '';
                }
            }
        </script>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
