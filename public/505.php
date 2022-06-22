<?php include $this->layout('base/head.php') ?>

<body>

    <?php include $this->layout('navbar/navbar-home.php') ?>

        <div class="container">

            <div class="main">

                <div class="error-block">
                    <div class="error-block-content">
                        <div class="error-block-info">
                            <h3>Версия не поддерживается</h3>

                            <span>
                                Версия HTTP не поддерживается браузером. Пожалуйста свяжитесь с администрацией сайта.
                                <br>
                                email@gmail.com
                            </span>

                            <a class="button button-success-border block-margin-top" href="/"><i class="icon-expand_left_right"></i> Вернуться на главную</a>
                        </div>
                        <div class="error-block-background">505</div>
                    </div>
                </div>

            </div>

        </div>

    <?php include $this->layout('footer/footer.php') ?>

</body>

<?php include $this->layout('base/foot.php') ?>
