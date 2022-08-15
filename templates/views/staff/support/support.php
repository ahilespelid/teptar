<?php include $this->layout('staff/base/head.php'); ?>

    <body>

        <?php include $this->layout('staff/menu.php'); ?>

        <div class="content">

            <?php include $this->layout('staff/header.php'); ?>

            <div class="body">
                <div class="reports-title">
                    <div class="reports-title__my-reports">
                        <div class="reports-title__my-reports__text">
                            <h1>Служба поддержки</h1>
                        </div>
                        <div class="reports-title__my-reports__btn">
                        </div>
                    </div>
                </div>

                <?php if (isset($_COOKIE['alert'])) { ?>
                    <?php $alert = json_decode($_COOKIE['alert']); ?>
                    <div class="alert alert-<?= $alert->type ?>">
                        <?= $alert->message ?>
                    </div>
                <?php } ?>

                <div class="reports_main">
                    <div class="main__first">
                        <div class="footer__info__time">
                            <span class="footer__info__time__name">Обратная связь</span>
                        </div>
                        <form action="/support" method="post">
                            <div class="textarea">
                                <label for="message"></label><textarea name="message" id="message"></textarea>
                            </div>
                            <div class="support__footer">
                                <div class="support__footer__text"></div>
                                <button type="submit" class="support__footer__button">Отправить</button>
                            </div>
                        </form>
                    </div>

                    <div class="footer">
                        <div class="footer__info">
                            <div class="footer__info__time">
                                <span class="footer__info__time__name">Служба поддержки</span>
                            </div>
                            <div class="footer__info__extra">
                                <div class="footer__info__extra__address">
                                    <i class="icon-pin"></i>
                                    <span class="text">г. Грозный, ул. Ленина, д. 5</span>
                                </div>
                                <div class="footer__info__extra__telephone">
                                    <i class="icon-phone"></i>
                                    <span class="text">+7 900 900 90 90</span>
                                </div>
                                <div class="footer__info__extra__second__telephone">
                                    <i class="icon-phone"></i>
                                    <span class="text">+7 900 900 90 90</span>
                                </div>
                                <div class="footer__info__extra__mail">
                                    <i class="icon-envelope"></i>
                                    <span class="text">info@grozny.ru</span>
                                </div>
                                <div class="footer__info__extra__site">
                                    <i class="icon-world"></i>
                                    <span class="text">mercedes-b.ru</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
