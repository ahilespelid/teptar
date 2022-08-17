<?php include $this->layout('staff/base/head.php'); ?>

    <body>

        <?php include $this->layout('staff/menu.php'); ?>

        <div class="content">

            <?php include $this->layout('staff/header.php'); ?>

            <div class="body">
                <div class="reports-title">
                    <div class="reports-title__my-reports">
                        <div class="reports-title__my-reports__text">
                            <h1>Обращении в службу поддержки</h1>
                            <a href="/messages/answers" class="button title-button">
                                Ответы на обращения
                            </a>
                        </div>
                    </div>
                </div>

                <div class="support-messages">

                    <?php if ($messages) { ?>

                        <?php foreach ($messages as $message) { ?>

                            <div class="actions__info-item">
                                <div class="actions__activity-info">

                                    <div class="actions__activity-user">
                                        <div class="avatar">
                                            <img src="<?= $message['avatar'] ?? $this->security->setEmptyAvatar() ?>" alt="Avatar">
                                        </div>
                                        <div class="info">
                                            <span class="name"><?= $message['firstname'] ?> <?= $message['secondname'] ?> <?= $message['lastname'] ?></span>
                                            <span class="post">
                                                <?= $message['post'] ?>
                                                <br>
                                                <?= (new \DateTime($message['date']))->format('d.m.o G:i')?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="actions__activity-message">
                                    <?= $message['message'] ?>
                                </div>

                                <div class="actions__activity-form">
                                    <form action="/messages" method="post">
                                        <label for="message"></label>
                                        <textarea name="message[<?= $message['id'] ?>]" id="message"></textarea>

                                        <button class="button button-success" type="submit">Ответить</button>
                                    </form>
                                </div>
                            </div>

                        <?php } ?>

                    <?php } else { ?>
                        У вас еще нет обращений без ответа
                    <?php }  ?>

                </div>

            </div>
        </div>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
