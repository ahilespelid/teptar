<?php include $this->layout('base/head.php') ?>

<body>

    <?php include $this->layout('navbar/navbar-home.php') ?>

        <div class="container">

            <div class="main">

                <div class="error-block">
                    <div class="error-block-content">
                        <div class="error-block-info">
                            <h3>Внутренняя ошибка сервера</h3>

                            <span>
                                Произошла внутренняя ошибка сервера, пожалуйста обратитесь к администрации сайта.
                                <br>
                                email@gmail.com
                            </span>

                            <a class="button button-success-border block-margin-top" href="/"><i class="icon-expand_left_right"></i> Вернуться на главную</a>
                        </div>
                        <div class="error-block-background">500</div>
                    </div>
                </div>

            </div>

        </div>

    <?php include $this->layout('footer/footer.php') ?>

</body>

<?php include $this->layout('base/foot.php') ?>
