<div class="menu<?php if (isset($_COOKIE['menu'])) { echo ' menu__folded'; }?>" id="menu">
    <div class="menu__main">

        <div class="menu__header">
            <img src="<?= $this->image('/assets/images/logo.svg'); ?>" alt="logo">
            <div class="menu__header__text"><b>ОЦЕНКА ЭФФЕКТИВНОСТИ</b> ОРГАНОВ МЕСТНОГО САМОУПРАВЛЕНИЯ</div>
        </div>

        <nav class="menu__body">

            <div class="menu__body__list">
                <?php $role = 2; ?>

                <?php if ($this->security->userHasRole(['ministry_boss', 'ministry_staff'])) { ?>
                    <a href="/districts" <?php if ($this->security->route == 'districts') { echo 'class="active"'; } ?>>
                        <span class="if_active">
                            <span class="icon-archive menu-icon"></span><span>Районы</span>
                        </span>
                    </a>
                <?php } else { ?>
                    <a href="/reports" <?php if ($this->security->route == 'reports') { echo 'class="active"'; } ?>>
                        <span class="if_active">
                            <span class="icon-archive menu-icon"></span><span>Отчеты</span>
                        </span>
                    </a>
                <?php } ?>

                <?php if ($this->security->userHasRole(['admin_admin'])) { ?>
                    <a href="/messages" <?php if ($this->security->route == 'messages' || $this->security->route == 'messages/answers') { echo 'class="active"'; } ?>>
                        <span class="if_active">
                            <span class="icon-envelope menu-icon"></span>
                            <span>Сообщении</span>
                            <?php if ($this->security->unreadMessages()) { ?>
                                <span class="menu-counter"><?= $this->security->unreadMessages() ?></span>
                            <?php } ?>
                        </span>
                    </a>

                    <a href="/profile/confirm" <?php if ($this->security->route == 'profile/confirm') { echo 'class="active"'; } ?>>
                        <span class="if_active">
                            <span class="icon-user menu-icon"></span>
                            <span>Новые сотрудники</span>
                            <?php if ($this->security->inactiveUsers()) { ?>
                                <span class="menu-counter"><?= $this->security->inactiveUsers() ?></span>
                            <?php } ?>
                        </span>
                    </a>
                <?php } ?>

                <a href="/disk" <?php if ($this->security->route == 'disk') { echo 'class="active"'; } ?>>
                    <span class="if_active">
                        <span class="icon-save_light menu-icon"></span><span>Диск</span>
                    </span>
                </a>

                <?php if ($this->security->userHasRole(['ministry_boss', 'ministry_staff'])) { ?>
                    <a href="/rating" <?php if ($this->security->route == 'rating') { echo 'class="active"'; } ?>>
                        <span class="if_active">
                            <span class="icon-chart menu-icon"></span><span>Рейтинг</span>
                        </span>
                    </a>
                <?php } ?>

                <a href="/notifications" <?php if ($this->security->route == 'notifications') { echo 'class="active"'; } ?>>
                     <span class="if_active">
                        <span class="icon-bell menu-icon notif-icon"></span><span>Уведомления</span>
                     </span>
                </a>

                <?php if ($this->security->userHasRole(['ministry_boss', 'district_boss'])) { ?>
                    <a href="/profile/new" <?php if ($this->security->route == 'profile/new') { echo 'class="active"'; } ?>>
                         <span class="if_active">
                            <span class="icon-user menu-icon notif-icon"></span><span>Добавить сотрудника</span>
                         </span>
                    </a>
                <?php } ?>
            </div>

            <div class="menu__body__list">
                <a href="/support" <?php if ($this->security->route == 'support') { echo 'class="active"'; } ?>>
                    <span class="if_active">
                        <span class="icon-setting menu-icon"></span><span>Служба поддержки</span>
                    </span>
                </a>
                <a href="/callCenter?type=ministry" <?php if ($this->security->route == 'callCenter') { echo 'class="active"'; } ?>>
                    <span class="if_active">
                        <span class="icon-dashboard_alt menu-icon"></span><span>Контакт-центр</span>
                    </span>
                </a>
                <a href="/profile?user=<?= $this->user()['login'] ?>" <?php if ($_SERVER['REQUEST_URI'] == 'profile?user=' . $this->user()['login']) { echo 'class="active"'; } ?>>
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
