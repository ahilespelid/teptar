<?php

require_once '../config/Db.php';
$connect = new Db;
$sql = 'SELECT * FROM districts';

?>

<nav class="navbar">
    <div class="navbar-container">

        <a class="main-logotype" href="/">
            <img src="/assets/images/logotype.svg" alt="Logotype">
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

            <div class="item dropdown dark rounded">
                <a class="current button button-success rounded"><i class="icon icon-map"></i> Чеченская республика</a>

                <div class="options">
                    <?php foreach ($connect->getAll($sql) as $district) { ?>
                        <a class="option" href="/region/index.php?district=<?= $district['mapname'] ?>"><?= $district['name'] ?></a>
                    <?php } ?>
                </div>
            </div>

            <div class="item dropdown dark rounded">
                <a class="current button button-light dark upper rounded"><i class="icon icon-map"></i> Документация</a>

                <div class="options">
                    <a class="option" href="#">1. Документация номер 1</a>
                    <a class="option" href="#">2. Документация номер 2</a>
                    <a class="option" href="#">3. Документация номер 3</a>
                    <a class="option" href="#">4. Документация номер 4</a>
                    <a class="option" href="#">5. Документация номер 5</a>
                </div>
            </div>
        </div>

        <div class="navbar-user">

            <div class="dropdown dark rounded">
                <div class="current">
                    <div class="username">
                        Авторизован как:
                        <br>
                        <span class="post">ГЛАВА РЕГИОНА</span>
                    </div>
                    <div class="avatar">
                        <img src="/assets/images/avatar.jpg" alt="Avatar"> <i class="icon-chevron-down"></i>
                    </div>
                </div>

                <div class="options">
                    <a class="option" href="/profile/index.php">
                        <i class="icon-user"></i> Профиль
                    </a>

                    <a class="option" href="/settings">
                        <i class="icon-setting"></i> Настройки
                    </a>

                    <span class="separator"></span>

                    <a class="option danger" href="/logout">
                        <i class="icon-log-out"></i> Выход
                    </a>
                </div>
            </div>

        </div>

    </div>
</nav>
