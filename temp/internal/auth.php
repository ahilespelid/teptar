<?php include 'base/head.php'; ?>

    <body>

        <div class="login-page">

            <div class="login-grid">

                <div class="logotype">
                   <img src="<?=$img['Logotype'];?>" alt="Logotype">
                </div>
                <div class="login-form">

                    <form method="post" action="/login">

                        <header class="user-title-block">
                            Вход в систему
                        </header>

                        <div class="form">

                            <div class="form-group">
                                <input type="text" name="uin" id="inputUIN" class="form-control" placeholder=" UIN">
                            </div>

                            <div class="form-group">
                                <input type="text" name="login" id="inputUsername" class="form-control" placeholder=" Пользователь">
                            </div>

                            <div class="form-group">
                                <input type="password" name="pass" id="inputPassword" class="form-control" placeholder=" Пароль">
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

<?php include 'base/foot.php'; ?>
