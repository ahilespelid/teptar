<header class="header">
    <div class="header__main">
<!--        <div class="header__input">-->
<!--            <input type="text" placeholder="Поиск">-->
<!--        </div>-->
        <div class="user">
            <div class="user__notification">
                <i class="icon-bell"></i>
                <span class="indicator"></span>
            </div>
            <div class="user__info">
                <img class="user__info__avatar" src="<?= $this->image('/assets/images/avatar.jpg'); ?>" alt="avatar">
                <span class="user__info__name">
                  <span>Ибрагим Грозный</span>
                  <span class="user__info__post">Районный сотрудник</span>
                </span>
                <span class="user__info__arrow">
                  <img width="32" height="32" src="/assets/img/svg/arrow_drop_down.svg" alt="&#x2193">
                </span>
                <div class="user__dropdown-menu none">
                    <div class="user__dropdown-menu__block">
                        <div class="user__dropdown-menu__block__variables"><a href="#">Мой профиль</a></div>
                        <div class="user__dropdown-menu__block__variables"><a href="#">Регистрация сотрудника</a></div>
                    </div>
                    <div class="user__dropdown-menu__block">
                        <div class="user__dropdown-menu__block__variables exit">Выход</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
