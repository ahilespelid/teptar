<?php include $this->layout('staff/base/head.php'); ?>

    <body>

        <?php include $this->layout('staff/menu.php'); ?>

            <div class="content">

                <?php include $this->layout('staff/header.php'); ?>

                <div class="body">

                    <div class="reports-title">
                        <div class="reports-title__my-reports">
                            <div class="reports-title__my-reports__text">
                                <h1>Районы</h1>
                            </div>
                            <div class="reports-title__my-reports__btn">
                            </div>
                        </div>
                    </div>

                    <div class="reports">
                        <div class="reports-list">

                            <div class="reports-list__title">
                                <div class="reports-list__title__element">
                                    Районы
                                </div>
                                <div class="reports-list__title__element reports-list__title__second-element">
                                    Последний отчет
                                </div>
                                <div class="reports-list__title__element reports-list__title__third-element">
                                    Эффективность
                                </div>
                                <div class="reports-list__title__element reports-list__title__fourth-element">
                                    Сотрудники
                                </div>
                            </div>

                            <div class="reports__body">
                                <?php foreach ($districts as $district) { ?>
                                    <div class="reports__body__line">

                                        <a href="/reports?district=<?= $district['district']['slug'] ?>">
                                            <div class="reports__body__line__name">
                                                <span><?= $district['district']['owner'] ?><span>
                                            </div>
                                        </a>

                                        <div class="reports__body__line__activity">
                                            <?= $district['report']['creating'] ?>
                                        </div>

                                        <div class="reports__body__line__term">
                                            <?php
                                                $class = '';
                                                if ($district['report']['status'] == 1) {
                                                    $class = '<span class="checked">Успешно</span>';
                                                } elseif ($district['report']['status'] == 3) {
                                                    $class = '<span class="warning">В работе</span>';
                                                } elseif ($district['report']['status'] == 4) {
                                                    $class = '<span class="warning">На проверке</span>';
                                                } elseif ($district['report']['status'] == 9) {
                                                    $class = '<span class="completed">Завершен</span>';
                                                }
                                            ?>

                                            <?= $class; ?>
                                        </div>

                                        <div class="reports__body__line__assistant">
                                            <div class="name-block<?php if ($district['staffCount'] > 2) { echo ' reports-list__more'; }?>">
                                                <?php if ($district['staffCount']) { ?>

                                                    <?php foreach ($district['staff'] as $staff) { ?>
                                                        <a href="/profile?user=<?= $staff['login'] ?>">
                                                            <img class="reports__body__avatar" style="background-image: url('<?= $staff['avatar'] ?? $this->security->setEmptyAvatar() ?>')">
                                                        </a>
                                                    <?php } ?>

                                                    <?php if ($district['staffCount'] > 2) { ?>
                                                        <span class="reports__body__number">+ <?= $district['staffCount'] - 2 ?></span>
                                                    <?php } ?>

                                                <?php } ?>
                                            </div>
                                        </div>

                                    </div>
                                <?php } ?>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
