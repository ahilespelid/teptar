<?php include $this->layout('staff/base/head.php'); ?>

    <body>

    <style>
        .report-form-title input {
            border: 1px solid #dde2e8;
            background: unset;
            height: 40px;
            width: 300px;
            padding: 8px 12px;
            border-radius: 4px;
        }

        .report-form-textarea textarea {
            width: 100%;
            border: unset;
            padding: 11px 14px;
            resize: none;
            background: unset;
            font-family: 'Open Sans', serif;
        }

        .report-form form div {
            margin-bottom: 12px;
        }

        .report-form form div:last-child {
            margin: unset;
        }

        .report-form-title, .report-form-staff, .report-form-actions {
            padding: 10px;
        }
    </style>

        <?php include $this->layout('staff/menu.php'); ?>

        <div class="content">

            <?php include $this->layout('staff/header.php'); ?>

            <div class="body">

                <div class="body__back-button">
                    <a href="#">
                        <span class="icon-expand_left_right body__back__arrow"></span>
                        Вернуться
                    </a>
                    <div class="body__back-button__icons">
                        <a href="#">
                      <span class="body__back-button__icon">
                        <span class="icon-save_light"></span>
                        Диск
                      </span>
                        </a>
                    </div>
                </div>

                <div class="reports-title">
                    <div class="reports-title__my-reports">
                        <div class="reports-title__my-reports__text">
                            <h1>Создание отчета</h1>
                        </div>
                        <div class="reports-title__my-reports__btn">
                        </div>
                    </div>
                </div>

                <?php
                    function selectYear(int $ago = null): string
                    {
                        if ($ago) {
                            return (new DateTime('now -' . $ago . ' year'))->format('Y');
                        } else {
                            return (new DateTime('now'))->format('Y');
                        }
                    }
                ?>

                <div class="report-form">

                    <form action="" method="post">

                        <div class="report-form-title chosen-search-off md-box">
<!--                            <span class="title">Отчет --><?//= selectYear() ?><!--</span>-->

                            <input type="text" placeholder="Название отчета">

                            <select id="selectReportYear" name="select" style="display: none">
                                <option value="<?= selectYear() ?>"><?= selectYear() ?></option>
                                <option value="<?= selectYear(1) ?>"><?= selectYear(1) ?></option>
                                <option value="<?= selectYear(2) ?>"><?= selectYear(2) ?></option>
                                <option value="<?= selectYear(3) ?>"><?= selectYear(3) ?></option>
                                <option value="<?= selectYear(4) ?>"><?= selectYear(4) ?></option>
                                <option value="<?= selectYear(5) ?>"><?= selectYear(5) ?></option>
                                <option value="<?= selectYear(6) ?>"><?= selectYear(6) ?></option>
                                <option value="<?= selectYear(7) ?>"><?= selectYear(7) ?></option>
                            </select>
                        </div>

                        <div class="report-form-textarea md-box">
                            <label>
                                <textarea placeholder="Описание отчета" name="reportDescription" rows="10"></textarea>
                            </label>
                        </div>

                        <div class="report-form-staff md-box">

                            <label for="tagReportUser">
                                <select id="tagReportUser" data-placeholder=" <?php if ($staffs) { ?>Добавить помощника<?php } else { ?>У вас еще нет сотрудников<?php } ?>" class="chosen-users" style="display: none" multiple="multiple"<?php if (!$staffs) { echo ' disabled'; } ?>>
                                    <?php foreach ($staffs as $staff) { ?>
                                        <option value="126"><?= $staff['firstname'] . ' ' . $staff['lastname'] ?></option>
                                    <?php } ?>
                                </select>
                            </label>

                        </div>

                        <div class="report-form-actions md-box">
                            <button type="submit" class="button button-success"><i class="icon-plus-circle"></i> Создать отчет</button>
                            <a class="button button-link"><i class="icon-cross-circle"></i> Отмена</a>
                        </div>
                    </form>

                </div>

            </div>

        </div>

        <script type="text/javascript" src="/build/chosen.js"></script>
        <script>
            $('#selectReportYear').chosen(
                {
                    width: 'auto',
                    allow_single_deselect: true,
                    max_selected_options: 3,
                    no_results_text: 'Нет записей',
                }
            );
            $('#tagReportUser').chosen(
                {
                    width: '100%',
                    allow_single_deselect: true,
                    max_selected_options: 3,
                    no_results_text: 'Нет записей',
                }
            );
        </script>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
