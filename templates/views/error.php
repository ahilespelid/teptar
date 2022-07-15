<?php include $this->layout('leader/base/head.php') ?>

    <body>

        <?php include $this->layout('leader/navbar.php') ?>

        <div class="container">

            <div class="main">

                <div class="error-block">
                    <div class="error-block-content">
                        <div class="error-block-info">
                            <h3><?= $title ?></h3>

                            <span>
                                <?= $message ?>
                            </span>

                            <a class="button button-outline-success rounded dark block-margin-top" href="/"><i class="icon-expand_left_right"></i> Вернуться на главную</a>
                        </div>
                        <div class="error-block-background"><?= $error ?></div>
                    </div>
                </div>

            </div>

        </div>

    </body>

<?php include $this->layout('leader/base/foot.php') ?>
