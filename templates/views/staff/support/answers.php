<?php include $this->layout('staff/base/head.php'); ?>

    <body>

        <?php include $this->layout('staff/menu.php'); ?>

        <div class="content">

            <?php include $this->layout('staff/header.php'); ?>

            <div class="body">
                <div class="body__back-button">
                    <a href="/messages">
                        <span class="icon-expand_left_right body__back__arrow"></span>
                        Вернуться
                    </a>
                </div>

                <div class="reports-title">
                    <div class="reports-title__my-reports">
                        <div class="reports-title__my-reports__text">
                            <h1>Ответы на обращения</h1>
                        </div>
                    </div>
                </div>

                <div class="support-messages">
                    
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
                                            <?= (new \DateTime($message['question_date']))->format('d.m.o G:i')?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="actions__activity-message">
                                <?= $message['question'] ?>
                            </div>

                            <div class="actions__activity-reply">
                                <span class="info">Ответ от службы поддержки:</span>
                                <span class="info"><?= (new \DateTime($message['answer_date']))->format('d.m.o G:i')?></span>
                                <span class="message">
                                    <?= $message['answer'] ?>
                                </span>
                            </div>
                        </div>

                    <?php } ?>

                </div>

            </div>
        </div>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
