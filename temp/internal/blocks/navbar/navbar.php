<nav class="navbar">
    <div class="navbar-container">

        <a class="main-logotype" href="/?in=index">
            <img src="<?=$GLOBALS['path']['use']['in'];?>/assets/images/logotype.png" alt="Logotype">
            <div class="text">
                <b>Чеченская республика</b>
                <span>Децентрализованная</span>
                <span>Блокчейн система</span>
            </div>
        </a>

        <div class="navbar-menu">
            <div class="item search">
                <form class="navbar-search" action="" method="post">
                    <input type="search" name="" placeholder=" Поиск" class="input" />
                </form>                                                                                                                         
            </div>
            <div class="item">
                <a href="/?in=index#districtsMap" class="button button-success"><i class="icon icon-map"></i> Чеченская республика</a>
            </div>
            <div class="item">
                <a href="/?in=documention" class="button button-link upper"><i class="icon icon-document"></i> Документация</a>
            </div>
        </div>

        <div class="navbar-user">

            <div class="dropdown custom">
                <div class="current">
                    <div class="username">
                        Авторизован как:
                        <br>
                        <span class="post">ГЛАВА РЕГИОНА</span>
                    </div>
                    <div class="avatar">
                        <img src="<?=$GLOBALS['path']['use']['in'];?>/assets/images/avatar.jpg" alt="Avatar"> <i class="icon-chevron-down"></i>
                    </div>
                </div>

                <div class="options">
                    <span class="option">
                        <a href="/?in=profile">
                            <i class="icon-user"></i> Профиль
                        </a>
                    </span>

                    <span class="option">
                        <a href="/?in=settings">
                            <i class="icon-setting"></i> Настройки
                        </a>
                    </span>

                    <span class="separator"></span>

                    <span class="option danger">
                        <a href="/?in=logout">
                            <i class="icon-log-out"></i> Выход
                        </a>
                    </span>
                </div>
            </div>

        </div>

    </div>
</nav>
