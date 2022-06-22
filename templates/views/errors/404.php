<?php include $this->layout('base/head.php') ?>

<body>

    <?php include $this->layout('navbar/navbar-home.php') ?>

        <div class="container">

            <div class="main">

                <div class="error-block">
                    <div class="error-block-content">
                        <div class="error-block-info">
                            <h3>Страница не найдена</h3>

                            <span>
                                Страницу которую вы искали не существует, пожалуйста выберите другую либо вернитесь на главную.
                            </span>

                            <a class="button button-success-border block-margin-top" href="/"><i class="icon-expand_left_right"></i> Вернуться на главную</a>
                        </div>
                        <div class="error-block-background">404</div>
                    </div>
                </div>

            </div>

        </div>

    <?php include $this->layout('footer/footer.php') ?>

</body>

<?php include $this->layout('base/foot.php') ?>
