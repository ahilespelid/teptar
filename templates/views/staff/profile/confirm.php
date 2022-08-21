<?php include $this->layout('staff/base/head.php'); ?>

    <body>

        <?php include $this->layout('staff/menu.php'); ?>

        <div class="content">

            <?php include $this->layout('staff/header.php'); ?>

            <div class="body">
                <div class="reports-title">
                    <div class="reports-title__my-reports">
                        <div class="reports-title__my-reports__text">
                            <h1>Новые сотрудники</h1>
                        </div>
                    </div>
                </div>

                <div class="support-messages">

                    <?php if ($users) { ?>

                        <?php foreach ($users as $user) { ?>

                            <div class="actions__info-item">
                                <div class="actions__activity-info">

                                    <div class="actions__activity-user">
                                        <div class="avatar">
                                            <img src="<?= $user['avatar'] ?? $this->security->setEmptyAvatar() ?>" alt="Avatar">
                                        </div>
                                        <div class="info">
                                            <span class="name"><?= $user['firstname'] ?> <?= $user['secondname'] ?> <?= $user['lastname'] ?></span>
                                            <span class="post">
                                                <?= $user['post'] ?>
                                                <br>
                                                <span class="muted">
                                                    <?php if ($user['type'] == 'district') { ?>
                                                        Район:
                                                    <?php } else { ?>
                                                        Министерство:
                                                    <?php } ?>
                                                    <?= $user['district'] ?>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="actions__activity-message">
                                    <b>Имя пользователя:</b> <?= $user['login'] ?>
                                    <br>
                                    <b>Дата рождения:</b> <?= (new \DateTime($user['age']))->format('d.m.o')?>
                                    <br>
                                    <b>Телефон:</b> <?= $user['phone'] ?>
                                    <br>
                                    <b>Почта:</b> <?= $user['email'] ?>
                                </div>

                                <a class="button button-success" href="/confirmUser?user=<?= $user['id'] ?>" onclick="return confirm('Вы уверены что хотите активировать сотрудника <?= $user['firstname'] . ' ' . $user['secondname'] .  ' ' . $user['lastname'] ?>?')">Активировать</a>
                                <a class="button button-danger" href="/deleteUser?user=<?= $user['id'] ?>" onclick="return confirm('Вы уверены что хотите удалить сотрудника <?= $user['firstname'] . ' ' . $user['secondname'] .  ' ' . $user['lastname'] ?>?')">Удалить</a>
                            </div>

                        <?php } ?>

                    <?php } else { ?>
                        Пока нет запросов на добавление новых сотрудников
                    <?php }  ?>

                </div>

            </div>
        </div>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
