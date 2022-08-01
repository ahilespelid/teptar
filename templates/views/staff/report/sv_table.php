<?php include $this->layout('staff/base/head.php'); ?>

    <body>

        <?php include $this->layout('staff/menu.php'); ?>

        <div class="content">

            <?php include $this->layout('staff/header.php'); ?>

            <div class="body report-table">
                <div class="developer-alert">
                    <i class="icon-refresh spin"></i> Страница «Сводная таблица» на стадии разработки, пожалуйста заходите позже
                </div>

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
                    <?php pa($_POST) ?>

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
                                        <th>Действие</th>
                                        <th>Итог</th>
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
                                                        <input type="text" name="marks[<?= $mark['num'] ?>][district]" placeholder="Индекс (района: <?= $uin['owner'] ?>)" id="districtMark<?= $mark['num'] ?>">
                                                    <?php } else { ?>
                                                        <input type="text">
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <label for="ministryMark<?= $mark['num'] ?>"></label>
                                                    <input type="text" name="marks[<?= $mark['num'] ?>][ministry]" placeholder="Индекс" id="ministryMark<?= $mark['num'] ?>">
                                                </td>
                                                <td>
                                                    <label for="markActions<?= $mark['num'] ?>"></label><select id="markActions<?= $mark['num'] ?>" name="marks[<?= $mark['num'] ?>][action]" data-placeholder="Выбрать действие">
                                                        <option value="0" selected>Выбрать действие</option>
                                                        <option value="agreed">Согласовано</option>
                                                        <option value="disagreed">Не согласовано</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <label for="districtResult<?= $mark['num'] ?>"></label>
                                                    <input type="text" name="marks[<?= $mark['num'] ?>][result]" placeholder="Итоговый индекс" id="districtResult<?= $mark['num'] ?>">
                                                </td>
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
            function disableEmptyInputs(form) {
                var controls = form.elements;
                for (var i=0, iLen=controls.length; i<iLen; i++) {
                    controls[i].disabled = controls[i].value === '';
                }
            }
        </script>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
