<?php include $this->layout('base/head.php'); ?>

    <body>

        <?php include $this->layout('navbar.php'); ?>

            <div class="container">

                <div class="main">

                    <?php include $this->layout('navbar-responsive.php'); ?>

                    <div class="grid-block column">
                        <div class="grid-block-main">
                            <div class="media">
                                <div class="avatar" style="background-image: url('<?= $staff['avatar'] ?>')"></div>
                            </div>
                            <span class="title"><?= $staff['lastname'] . ' ' . $staff['firstname'] . ' ' . $staff['secondname'] ?></span>
                            <span class="muted"><?= $role['post'] ?></span>
                            <span class="muted"><i class="icon-pin"></i> <?= $uin['center'] ?>, Российская Федерация</span>
                            <span class="social">
                                <?php if ($staff['social_in']) { ?>
                                    <a href="https://<?= $staff['social_in'] ?>"><i class="icon-instagram"></i></a>
                                <?php } ?>

                                <?php if ($staff['social_tg']) { ?>
                                    <a href="https://<?= $staff['social_tg'] ?>"><i class="icon-telegram"></i></a>
                                <?php } ?>

                                <?php if ($staff['social_vk']) { ?>
                                    <a href="https://<?= $staff['social_vk'] ?>"><i class="icon-vk"></i></a>
                                <?php } ?>
                            </span>
                        </div>
                        <div class="data">
                            <div class="column-item">
                                <div class="block-box block-title-box">
                                    <h3>Контакты</h3>
                                </div>
                                <div class="item">
                                    <div class="content">
                                        <span>Почта</span>
                                        <span><?= $staff['email'] ?></span>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="content">
                                        <span>Телефон</span>
                                        <span>+<?= $staff['phone'] ?></span>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="content">
                                        <span>Рабочий телефон</span>
                                        <span>+<?= $staff['phone_work'] ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="column-item">
                                <div class="block-box block-title-box">
                                    <h3>Дополнительные данные</h3>
                                </div>
                                <div class="item">
                                    <div class="content">
                                        <span>Пол</span>
                                        <span>
                                            <?php if ($staff['gender'] == true) { ?>
                                                Мужской
                                            <?php } else { ?>
                                                Женский
                                            <?php } ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="content">
                                        <span>Дата рождения</span>
                                        <span><?= (new DateTime($staff['age'] . '-1 year'))->format('d.m.o') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        <?php include $this->layout('footer.php'); ?>

    </body>

<?php include $this->layout('base/foot.php'); ?>
