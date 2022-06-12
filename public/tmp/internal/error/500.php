<?php include '../base/head.php' ?>

<body>

    <?php include '../blocks/navbar/navbar.php' ?>

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

    <?php include '../blocks/footer/footer.html';?>

</body>

<?php include '../base/foot.php' ?>
