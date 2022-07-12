<?php include $this->layout('staff/base/head.php'); ?>

<body>

    <?php include $this->layout('staff/menu.php'); ?>

    <div class="content">

        <?php include $this->layout('staff/header.php'); ?>

        <div class="body">
            <div class="body__back-button">
                <a href="/districts">
                    <img width="16" height="16" src="/assets/img/svg/expand_left_right.svg" alt="&#8249">
                    Вернуться к списку районов
                </a>
            </div>

            <div class="reports-title">
                <div class="reports-title__my-reports">
                    <div class="reports-title__my-reports__text">
                        <h1><?= $district['owner'] ?></h1>
                    </div>
                    <div class="reports-title__my-reports__btn">
                    </div>
                </div>
                <div class="sort">
                    <span class="sort__toggle">
                        Сортировать по:
                        <span class="sort__toggle__time">Году</span>
                        <img src="/assets/img/svg/sort.svg">
                    </span>
                    <div class="sort__block none">
                        <div class="sort__block__element"><span class="icon-folder_alt sort-element"></span>По годам</div>
                        <div class="sort__block__element"><span class="icon-save_light sort-element"></span>По месяцам</div>
                        <div class="sort__block__element"><span class="icon-save_light sort-element"></span>По важности</div>
                        <div class="sort__block__element"><span class="icon-save_light sort-element"></span>По просмотрам</div>
                    </div>
                </div>
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
                            Помощник
                        </div>
                        <div class="reports-list__title__element">
                            Глава Района
                        </div>
                    </div>
                    <div class="reports__body">

                        <?php $status = '';

                            function reportStatus($name) {
                                $statuses = [
                                        'Успешно' => 'finished',
                                        'В работе' => 'warning',
                                        'Дорабатывается' => 'expired',
                                        'Завершен' => '',
                                ];

                                echo ' ' . $statuses[$name];
                            }

                        ?>

                        <?php foreach ($reports as $report) { ?>

                            <div class="reports__body__line<?php reportStatus($report['status']['name']) ?>">
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
                                    <?= $report['report']['deadline'] ?>
                                </div>
                                <div class="reports__body__line__assistant">
                                    <div class="name-block">
                                        <img src="<?= $report['staff']['avatar'] ?>" class="reports__body__avatar">
                                        <span class="name">
                                            <?= $report['staff']['firstname'] . ' ' . $report['staff']['lastname'] ?>
                                        </span>
                                        <div class="reports__body__number"></div>
                                    </div>
                                </div>
                                <div class="reports__body__line__responsible">
                                    <div class="name-block">
                                        <img src="<?= $report['boss']['avatar'] ?>" class="reports__body__avatar"><span class="name"><?= $report['boss']['firstname'] . ' ' . $report['boss']['lastname'] ?></span>
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

</body>

<?php include $this->layout('staff/base/foot.php'); ?>
