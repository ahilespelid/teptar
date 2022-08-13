<?php include $this->layout('staff/base/head.php'); ?>

    <body>

        <?php include $this->layout('staff/menu.php'); ?>

        <div class="content">

            <?php include $this->layout('staff/header.php'); ?>

            <div class="body report-table sv-table">

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
                    <a href="/report/table?report=<?= $report['id'] ?>">
                        <span class="icon-expand_left_right body__back__arrow"></span>
                        Вернуться
                    </a>
                    <div class="body__back-button__tables">
                        <a href="/report/table?report=<?= $report['id'] ?>" class="finished__table">
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
                            <thead class="table__main__header">
                                <tr>
                                    <th>Показатель</th>
                                    <th>Описание</th>
                                    <th>Ед. измерения</th>
                                    <th>Ведомство</th>
                                    <th>Район</th>
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
                                                <?php if ($this->security->userHasRole(['ministry_boss', 'ministry_staff'])) { ?>
                                                    <label for="ministryMark<?= $mark['num'] ?>"></label>
                                                    <input class="ministry-index-input" type="text" name="marks[<?= $mark['num'] ?>][ministry]" <?= (isset($mark['ministry'])) ? 'value="' . $mark['ministry'] .  '"' : '' ?> placeholder="Индекс министерства" id="ministryMark<?= $mark['num'] ?>">
                                                <?php } else { ?>
                                                    <label>
                                                        <input class="ministry-index-input not-current" type="text" <?= (isset($mark['ministry'])) ? 'value="' . $mark['ministry'] .  '"' : '' ?> placeholder="Не введен" disabled>
                                                    </label>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($this->security->userHasRole(['district_boss', 'district_staff'])) { ?>
                                                    <label for="districtMark<?= $mark['num'] ?>"></label>
                                                    <input class="district-index-input" type="text" name="marks[<?= $mark['num'] ?>][district]" <?= (isset($mark['district'])) ? 'value="' . $mark['district'] .  '"' : '' ?> placeholder="Индекс района" id="districtMark<?= $mark['num'] ?>">
                                                <?php } else { ?>
                                                    <label>
                                                        <input class="district-index-input not-current" type="text" <?= (isset($mark['district'])) ? 'value="' . $mark['district'] .  '"' : '' ?> placeholder="Не введен" disabled>
                                                    </label>
                                                <?php } ?>
                                            </td>
                                            <?php if ($this->security->userHasRole(['district_boss', 'district_staff'])) { ?>
                                                <td>
                                                    <div class="chosen-search-off">
                                                        <label for="markActions<?= $mark['num'] ?>"></label>
                                                        <select class="markAction" id="markActions<?= $mark['num'] ?>" name="marks[<?= $mark['num'] ?>][action]" data-placeholder="Выбрать действие">
                                                            <option value="0" selected>Выбрать действие</option>
                                                            <option value="agreed">Согласовано</option>
                                                            <option value="disagreed">Не согласовано</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <label for="districtResult<?= $mark['num'] ?>"></label>
                                                    <div class="table-result-block">
                                                        <div class="result active">
                                                            <input class="result-index-input not-current" type="text" value="<?= (isset($mark['result'])) ? $mark['result'] : 'Не согласовано' ?>" placeholder="Не введен" disabled>
                                                        </div>
                                                        <div class="input">
                                                            <input type="text" <?= (isset($mark['result'])) ? 'value="' . $mark['result'] .  '"' : '' ?> name="marks[<?= $mark['num'] ?>][result]" placeholder="Итоговый индекс" id="districtResult<?= $mark['num'] ?>">
                                                        </div>
                                                    </div>
                                                </td>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <td colspan="6"><?= $mark['name'] ?></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div class="table-actions">
                            <input type="submit" class="profile__form__footer__button" value="Сохранить изменения">
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <script type="text/javascript" src="/build/chosen.js"></script>

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
            //
            $('.markAction').chosen(
                {
                    width: '200px',
                    allow_single_deselect: true,
                    max_selected_options: 3,
                    no_results_text: 'Нет сотрудников по запросу:',
                }
            ).change((item) => {
                let select = document.getElementById(item.currentTarget.id);
                let option = select.selectedOptions[0].value;
                let line = select.closest('tr');
                let result = line.querySelector('.table-result-block .result');
                let input = line.querySelector('.table-result-block .input');

                if (option === 'agreed') {
                    result.classList.remove('active');
                    input.classList.add('active')
                } else {
                    result.classList.add('active');
                    input.classList.remove('active')
                }

                // $(document).ready(() => {
                //     document.querySelectorAll('tbody tr').forEach((line) => {
                //         line.querySelector('select').addEventListener('blur', (select) => {
                //             let selected = select.target.selectedOptions[0];
                //
                //             console.log(selected);
                //         });
                //     });
                // });
            })
            ;

            // function disableEmptyInputs(form) {
            //     var controls = form.elements;
            //     for (var i=0, iLen=controls.length; i<iLen; i++) {
            //         controls[i].disabled = controls[i].value === '';
            //     }
            // }
        </script>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
