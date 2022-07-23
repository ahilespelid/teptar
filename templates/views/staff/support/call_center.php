<?php include $this->layout('staff/base/head.php'); ?>

    <body>

        <?php include $this->layout('staff/menu.php'); ?>

        <div class="content">

            <?php include $this->layout('staff/header.php'); ?>

            <div class="body">
<!--                <div class="body__back-button">-->
<!--                    <a href="#">-->
<!--                        <img width="16" height="16" src="--><!--/assets/img/svg/expand_left_right.svg" alt="&#8249">-->
<!--                        Вернуться-->
<!--                    </a>-->
<!--                </div>-->
                <div class="reports-title">
                    <div class="reports-title__my-reports">
                        <div class="reports-title__my-reports__text">
                            <h1>Контакт центр</h1>
                        </div>
                        <div class="reports-title__my-reports__btn">
                        </div>
                    </div>
                </div>
                <div class="reports-title choose__list">
                    <div class="choose__list__buttons">
                        <a href="/callCenter?type=ministry" class="<?= ($_GET['type'] == 'ministry') ? 'active__button' : 'non__active__button' ?>">Министерство</a>
                        <a href="/callCenter?type=district" class="<?= ($_GET['type'] == 'district') ? 'active__button' : 'non__active__button' ?>">Районы</a>
                    </div>
                </div>
                <div class="call-centers">
                    <?php require_once '_centers.php' ?>
                </div>
                <div class="call-center-footer">
                    <div class="footer__info">
                        <div class="footer__info__time">
                            <span class="footer__info__time__name"><?= $centers[0]['owner'] ?></span>
                        </div>
                        <div class="footer__info__extra">
                            <div class="footer__info__extra__address">
                                <i class="icon-pin"></i>
                                <span class="text"><?= $centers[0]['address'] ?></span>
                            </div>
                            <div class="footer__info__extra__telephone">
                                <i class="icon-phone"></i>
                                <span class="text"><?= $centers[0]['phone'] ?></span>
                            </div>
                            <div class="footer__info__extra__mail">
                                <i class="icon-envelope"></i>
                                <span class="text"><?= $centers[0]['email'] ?></span>
                            </div>
                            <div class="footer__info__extra__site">
                                <i class="icon-world"></i>
                                <span class="text"><?= $centers[0]['website'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="footer__map">
                        <div class="footer__map__itself">
                            <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A9a2dc468a0903afc3719ffaa936ee9156939d6c935b6c498a97c86f55dbfda5c&amp;source=constructor" width="724" height="400" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script>
            document.querySelectorAll('.reports__body__line').forEach((line) => {
                line.addEventListener('click', () => {
                    line.querySelector('.spinner').innerHTML = '<i class="spin icon-refresh"></i>';
                    document.querySelector('.reports__body__line.active').classList.toggle('active');
                    line.classList.toggle('active');

                    let uinId = line.id.replace('center', '');
                    $.getJSON('/uinData?id=' + uinId, (center) => {
                        document.querySelector('.footer__info__extra__address .text').innerHTML = center.address;
                        document.querySelector('.footer__info__extra__telephone .text').innerHTML = center.phone;
                        document.querySelector('.footer__info__extra__mail .text').innerHTML = center.email;
                        document.querySelector('.footer__info__extra__site .text').innerHTML = center.website;
                        document.querySelector('.footer__info__time__name').innerHTML = center.owner;
                        document.querySelector('iframe').src = 'https://yandex.ru/map-widget/v1/?um=constructor%3A9a2dc468a0903afc3719ffaa936ee9156939d6c935b6c498a97c86f55dbfda5c&amp;source=constructor';
                        line.querySelector('.spinner').innerHTML = '';
                    });
                })
            })
        </script>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
