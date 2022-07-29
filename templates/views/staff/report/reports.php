<?php include $this->layout('staff/base/head.php'); ?>

    <body>

        <?php include $this->layout('staff/menu.php'); ?>

        <div class="content">

            <?php include $this->layout('staff/header.php'); ?>

            <div class="body">

                <?php if ($this->security->userHasRole(['ministry_boss', 'ministry_staff'])) { ?>
                    <div class="body__back-button">
                        <a href="/districts">
                            <img width="16" height="16" src="/assets/img/svg/expand_left_right.svg" alt="&#8249">
                            Вернуться к списку районов
                        </a>
                    </div>
                <?php } ?>

                <div class="reports-title">
                    <div class="reports-title__my-reports">
                        <div class="reports-title__my-reports__text">
                            <h1>Отчеты</h1>
                            <span class="title">(Район: <?= $district['owner'] ?>)</span>
                        </div>
                        <?php if ($this->security->userHasRole(['district_boss']) && $lastReportCreated) { ?>
                            <div class="reports-title__my-reports__btn">
                                <a href="/report/new" class="button button-success"><i class="icon-plus-circle"></i> Новый отчет</a>
                            </div>
                        <?php } ?>
                    </div>
    <!--                <div class="sort">-->
    <!--                    <span class="sort__toggle">-->
    <!--                        Сортировать по:-->
    <!--                        <span class="sort__toggle__time">Году</span>-->
    <!--                        <img src="/assets/img/svg/sort.svg">-->
    <!--                    </span>-->
    <!--                    <div class="sort__block none">-->
    <!--                        <div class="sort__block__element"><span class="icon-folder_alt sort-element"></span>По годам</div>-->
    <!--                        <div class="sort__block__element"><span class="icon-save_light sort-element"></span>По месяцам</div>-->
    <!--                        <div class="sort__block__element"><span class="icon-save_light sort-element"></span>По важности</div>-->
    <!--                        <div class="sort__block__element"><span class="icon-save_light sort-element"></span>По просмотрам</div>-->
    <!--                    </div>-->
    <!--                </div>-->
                </div>

                <div class="reports">
                    <div class="reports-list">
                        <div class="reports-list__title">
                            <div class="reports-list__title__element">
                                <input type="checkbox" class="reports-list__title__checkbox">
                                <i class="icon-setting"></i>
                                Название
                            </div>
                            <div class="reports-list__title__element">
                                Эффективность
                            </div>
                            <div class="reports-list__title__element">
                                Крайний срок
                            </div>
                            <div class="reports-list__title__element">
                                Помощники
                            </div>
                            <div class="reports-list__title__element">
                                Глава Района
                            </div>
                        </div>
                        <div class="reports__body">

                            <?php $status = '';

                                function reportStatus($name) {
                                    $statuses = [
                                            1 => 'finished',
                                            2 => 'expired',
                                            3 => 'warning',
                                            4 => '',
                                    ];

                                    echo ' ' . $statuses[$name];
                                }

                            ?>

                            <?php foreach ($reports as $report) { ?>

                                <div class="reports__body__line<?php reportStatus($report['status']['id']) ?>">
                                    <div class="reports__body__line__name">
                                        <input type="checkbox" id="checkbox-0" class="reports__body__checkbox">
                                        <i class="icon-menu reports__body__i"></i>
                                        <a href="/report?id=<?= $report['report']['id'] ?>">
                                            <span><?= $report['report']['name'] ?><span>
                                        </a>
                                    </div>
                                    <div class="reports__body__line__activity">
                                        <?= $report['status']['name'] ?>
                                    </div>
                                    <div class="reports__body__line__term">
                                        <?php if ($report['report']['deadline']) { ?>
                                            <?= (new DateTime($report['report']['deadline']))->format('d.m.o') ?>
                                        <?php } ?>
                                    </div>
                                    <div class="reports__body__line__assistant">
                                        <div class="name-block<?php if ($report['staffCount'] > 2) { echo ' reports-list__more'; }?>">
                                            <?php if ($report['staffCount']) { ?>

                                                <?php foreach ($report['staffs'] as $staff) { ?>
                                                    <a href="/profile?user=<?= $staff['login'] ?>">
                                                        <img class="reports__body__avatar" style="background-image: url('<?= $staff['avatar'] ?? $this->security->setEmptyAvatar() ?>')">
                                                    </a>
                                                <?php } ?>

                                                <?php if ($report['staffCount'] > 2) { ?>
                                                    <span class="reports__body__number">+ <?= $report['staffCount'] - 2 ?></span>
                                                <?php } ?>

                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="reports__body__line__responsible">
                                        <div class="name-block">
                                            <a href="/profile?user=<?= $report['boss']['login'] ?>">
                                                <img src="<?= $report['boss']['avatar'] ?? $this->security->setEmptyAvatar() ?>" class="reports__body__avatar">
                                            </a>
                                            <span class="name"><?= $report['boss']['firstname'] . ' ' . $report['boss']['lastname'] ?></span>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>

                <div class="reports-footer none">
                    <div class="reports-footer__action">
                        <span>Выгрузить</span>
                        <div class="reports-footer__action__sort none">
                            <div class="variables excel">
                                <img width="30" height="30" src="<?= $this->image('/assets/images/staff/xlsx.svg'); ?>">
                                Выгрузить в Excel
                            </div>
                            <div class="variables word">
                                <img width="30" height="30" src="<?= $this->image('/assets/images/staff/word.svg'); ?>">
                                Выгрузить в Word
                            </div>
                            <div class="variables pdf">
                                <img width="30" height="30" src="<?= $this->image('/assets/images/staff/pdf.svg'); ?>">
                                Выгрузить в PDF
                            </div>
                        </div>
                        <!--                <img width="24" height="24" src="../assets/img/svg/arrow_drop_down_black.svg" alt="&#x2193">-->
                        <span class="icon-arrow_drop_down dropdown-arrow"></span>
                    </div>

                    <div class="reports-footer__submit__button">
                        <button>Применить</button>
                    </div>

                    <div class="reports-footer__count">Отмечено <span class="reports-checked"></span>/<span class="reports-count"></span></div>
                </div>

            </div>

        </div>

        <script type="text/javascript" src="/build/chosen.js"></script>
        <script>
            $('#reportsYear').chosen(
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
