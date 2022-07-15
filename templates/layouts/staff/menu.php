<div class="menu" id="menu">
    <div class="menu__main">

        <div class="menu__header">
            <img src="<?= $this->image('/assets/images/logo.svg'); ?>" alt="logo">
            <div class="menu__header__text"><b>ОЦЕНКА ЭФФЕКТИВНОСТИ</b> ОРГАНОВ МЕСТНОГО САМОУПРАВЛЕНИЯ</div>
        </div>

        <nav class="menu__body">

            <div class="menu__body__list">
                <?php $role = 2; ?>

                <?php if($role === 1) { ?>
                    <a href="/?ex=reports#" id="my-reports">
                        <span class="if_active">
                            <span class="icon-archive menu-icon"></span><span>Мои отчеты</span>
                        </span>
                    </a>
                <?php } else { ?>
                    <a href="/?ex=districts#" id="districts">
                        <span class="if_active">
                            <span class="icon-archive menu-icon"></span><span>Районы</span>
                        </span>
                    </a>
                <?php } ?>

                <a href="#" id="disc">
                    <span class="if_active">
                        <span class="icon-save_light menu-icon"></span><span>Диск</span>
                    </span>
                </a>
                <a href="/?ex=notifications#" id="notifications">
                     <span class="if_active">
                        <span class="icon-bell menu-icon notif-icon"></span><span>Уведомления</span>
                     </span>
                </a>

                <?php if ($role === 2) { ?>
                    <a href="/?ex=registration#" id="registration">
                         <span class="if_active">
                            <span class="icon-user menu-icon notif-icon"></span><span>Добавить сотрудника</span>
                         </span>
                    </a>
                <?php } ?>
            </div>

            <div class="menu__body__list">
                <a href="#" id="support">
                    <span class="if_active">
                        <span class="icon-setting menu-icon"></span><span>Служба поддержки</span>
                    </span>
                </a>
                <a href="#" id="contact">
                    <span class="if_active">
                        <span class="icon-dashboard_alt menu-icon"></span><span>Контакт-центр</span>
                    </span>
                </a>
                <a href="#" id="profile">
                    <span class="if_active">
                        <span class="icon-user menu-icon"></span><span>Профиль</span>
                    </span>
                </a>
            </div>

        </nav>

        <div class="menu__footer">
            <span class="menu__footer__toggle">
                <a>
                    <span class="icon-toggle toggle-icon"></span>
                    <span class="menu__footer__text">
                        Свернуть панель
                    </span>
                </a>
            </span>
        </div>

    </div>
</div>
