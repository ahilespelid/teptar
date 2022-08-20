<?php include $this->layout('leader/base/head.php'); ?>

    <body>

        <div class="login-page">

            <div class="login-grid">

                <div class="logotype">
                    <img src="<?= $this->image('/assets/images/logotype.svg'); ?>" alt="Logotype">
                </div>
                <div class="login-form">

                    <form method="post" action="/login">
                    
                        <header class="user-title-block">
                            Вход в систему
                        </header>

                        <?php if (isset($_COOKIE['defense'])) { ?>
                            <?php $cookie = json_decode($_COOKIE['defense']) ?>
                            <?php if ($cookie->attempts >= 3) { ?>
                                <?php
                                $date = new DateTime($cookie->time->date);
                                $now = new DateTime('now');
                                $diff = $date->diff($now);
                                ?>
                                <div class="form-alert">
                                    Вы ввели неправильные данные <?= $cookie->attempts ?> раза, подождите <?= $diff->i . ':' . $diff->s . ' м.' ?> чтобы попробовать еще раз
                                </div>
                            <?php } ?>
                        <?php } ?>

                        <div class="form">

                            <div class="form-group">
                                <label for="inputUIN"></label><input type="text" name="uin[name]" id="inputUIN" class="form-control" placeholder=" UIN">
                            </div>

                            <div class="form-group">
                                <label for="inputLogin"></label><input type="text" name="login" id="inputLogin" class="form-control" placeholder=" Пользователь">
                            </div>

                            <div class="form-group">
                                <label for="inputPass"></label><input type="password" name="pass" id="inputPass" class="form-control" placeholder=" Пароль">
                            </div>

                            <button class="btn btn-primary mt-1" type="submit">
                                Войти
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        <style>
            .form-alert {
                background-color: rgba(255,255,255,0.03);
                border-radius: 6px;
                padding: 12px 14px;
                margin-bottom: 20px;
                color: #e1a6a6;
                line-height: 24px;
            }
        </style>

    </body>

<?php include $this->layout('leader/base/foot.php'); ?>
