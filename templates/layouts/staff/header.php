<header class="header" data-pagetype="staff">
    <div class="header__main">
<!--        <div class="header__input">-->
<!--            <input type="text" placeholder="Поиск">-->
<!--        </div>-->
        <div class="user">
            <a href="/notifications">
                <div class="user__notification">
                    <i class="icon-bell"></i>
                    <?php if ($this->security->userHasNotification()) { ?>
                        <span class="indicator"></span>
                    <?php } ?>
                </div>
            </a>
            <div class="user__info">
                <img class="user__info__avatar" src="<?= $this->user()['avatar'] ?? $this->security->setEmptyAvatar() ?>" alt="avatar">
                <span class="user__info__name">
                  <span><?= $this->user()['firstname'] . ' ' . $this->user()['lastname'] ?></span>
                  <span class="user__info__post"><?= $this->user()['role']['post'] ?></span>
                </span>
                <span class="user__info__arrow">
                    <i class="icon-arrow_drop_down"></i>
                </span>
                <div class="user__dropdown-menu none">
                    <div class="user__dropdown-menu__block">
                        <div class="user__dropdown-menu__block__variables"><a href="/profile?user=<?= $this->user()['login'] ?>">Мой профиль</a></div>
                    </div>
                    <div class="user__dropdown-menu__block">
                        <a href="/?logout">
                            <div class="user__dropdown-menu__block__variables exit">Выход</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
