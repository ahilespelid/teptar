<?php include $this->layout('staff/base/head.php'); ?>

    <body>

        <?php include $this->layout('staff/menu.php'); ?>

        <div class="content">

            <?php include $this->layout('staff/header.php'); ?>

            <div class="body">

<!--                <div class="body__back-button">-->
<!--                    <a href="#">-->
<!--                        <span class="icon-expand_left_right body__back__arrow"></span>-->
<!--                        Вернуться-->
<!--                    </a>-->
<!--                </div>-->

                <div class="reports-title">
                    <div class="reports-title__my-reports">
                        <div class="reports-title__my-reports__text">
                            <h1>Создание отчета</h1>
                        </div>
                        <div class="reports-title__my-reports__btn">
                        </div>
                    </div>
                </div>

                <div class="report-form">

                    <form action="" method="post">

                        <div class="report-form-title chosen-search-off md-box">
                            <h2>
                                <?= $deadline['name'] ?>
                            </h2>
                            <span class="report-deadline">Крайний срок сдачи отчета: <?= (new DateTime($deadline['date']))->format('d.m.o') ?></span>
                        </div>

                        <div class="report-form-textarea md-box">
                            <label>
                                <textarea placeholder="Описание отчета" name="report_description" rows="10"></textarea>
                            </label>
                        </div>

                        <div class="report-form-staff md-box">
                            <label for="tagReportUser">
                                <select id="tagReportUser" name="report_staff[]" data-placeholder=" <?php if ($staffs) { ?>Добавить помощника<?php } else { ?>У вас еще нет сотрудников<?php } ?>" class="chosen-users" style="display: none" multiple="multiple"<?php if (!$staffs) { echo ' disabled'; } ?>>
                                    <?php foreach ($staffs as $staff) { ?>
                                        <option value="<?= $staff['id'] ?>"><?= $staff['firstname'] . ' ' . $staff['lastname'] ?></option>
                                    <?php } ?>
                                </select>
                            </label>
                        </div>

                        <div class="report-form-actions md-box">
                            <button type="submit" class="button button-success"><i class="icon-plus-circle"></i> Создать отчет</button>
                            <a href="/reports" class="button button-link"><i class="icon-cross-circle"></i> Отмена</a>
                        </div>

                    </form>

                </div>

            </div>

        </div>

        <script type="text/javascript" src="/build/chosen.js"></script>
        <script>
            $('#tagReportUser').chosen(
                {
                    width: '100%',
                    allow_single_deselect: true,
                    max_selected_options: 3,
                    no_results_text: 'Нет сотрудников по запросу:',
                }
            );
        </script>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
