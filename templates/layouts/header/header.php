<?php
define('_DS_', DIRECTORY_SEPARATOR);
$url = $_SERVER['DOCUMENT_ROOT'];
?>

<script src="<?$url;?>/templates/assets/jquery-3.6.0.min.js"></script>
<script type="text/javascript"  src="<?$url;?>/templates/layouts/headerer/header.js"></script>
<script type="text/javascript"  src="<?$url;?>/templates/layouts/headerer/__main.js"></script>

<header class="header">
    <div class="header__main">
        <div class="header__input">
            <img src="<?$url;?>/assets/images/svg/search.svg" alt="search">
            <input type="text" placeholder="Поиск">
        </div>
        <div class="user">
            <div class="user__notification">
                <img src="<?$url;?>/assets/images/svg/notifications.svg" alt="notifications">
            </div>
            <div class="user__info">
                <img class="user__info__avatar" src="<?$url;?>/templates/views/reports/assets/img/avatar.jpg" alt="avatar">
                <span class="user__info__name">
                  <span>Ибрагим Грозный</span>
                  <span class="user__info__post">Районный сотрудник</span>
                </span>
                <span class="user__info__arrow">
                  <img width="32" height="32" src="<?$url;?>/assets/images/svg/arrow_drop_down.svg" alt="&#x2193">
                </span>
                <div class="user__dropdown-menu none">
                    <div class="user__dropdown-menu__block">
                        <div class="user__dropdown-menu__block__variables">Мой профиль</div>
                        <div class="user__dropdown-menu__block__variables">Настройки</div>
                    </div>
                    <div class="user__dropdown-menu__block">
                        <div class="user__dropdown-menu__block__variables exit">Выход</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>