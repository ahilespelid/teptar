<?php include $this->layout('base/head.php'); ?>

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

                        <div class="form">

                            <div class="form-group">
                                <label for="inputUIN"></label><input type="text" name="uin[name]" id="inputUIN" class="form-control" placeholder=" UIN">
                            </div>

                            <div class="form-group">
                                <label for="inputLogin"></label><input type="text" name="login" id="inputLogin" class="form-control" placeholder=" Пользователь">
                            </div>

                            <div class="form-group">
                                <label for="inputPass"></label><input type="password" name="pass" id="inputPass" class="form-control" placeholder=" Пароль">
                            </div>

                            <button class="btn btn-primary mt-1" type="submit">
                                Войти
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </body>

<?php include $this->layout('base/foot.php'); ?>
