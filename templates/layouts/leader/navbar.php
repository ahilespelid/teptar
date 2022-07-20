<nav class="navbar">
    <div class="navbar-container<?php if (isset($navbar) && $navbar == 'error') { echo ' navbar-container-center'; } ?>">

        <a class="main-logotype" href="/">
            <img src="<?= $this->image('/assets/images/logotype.svg'); ?>" alt="Logotype">
            <div class="text">
                <b>Оценка эффективности</b>
                <span>органов местного</span>
                <span>самоуправления</span>
            </div>
        </a>

        <?php if (isset($navbar) && $navbar == 'error') { ?>
        <?php } else { ?>

            <div class="navbar-menu">
                <div class="item search">
                    <form class="navbar-search" action="" method="post">
                        <input type="search" name="" placeholder=" Поиск" class="input" />
                    </form>
                </div>

                <?php if (isset($navbar) && $navbar == 'home') { ?>
                    <div class="item">
                        <a href="#districtsMap" class="button button-success rounded"><i class="icon icon-map"></i> Чеченская республика</a>
                    </div>
                <?php } else { ?>
                    <div class="item dropdown dark rounded">
                        <a class="current button button-success rounded"><i class="icon icon-map"></i> Чеченская республика</a>

                        <div class="options">
                            <div class="dropdown-map">
                                <?php include $this->layout('leader/map.php'); ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="item dropdown dark rounded">
                    <a class="current button button-light dark upper rounded"><i class="icon icon-desk"></i> Документация</a>

                    <div class="options">
                        <div class="dropdown-buttons-block">
                            <a href="#" class="button button-outline-success rounded">Мониторинг и анализ целевых показателей</a>
                            <a href="#" class="button button-outline-success rounded">Ключевые показатели деятельности ОМСУ</a>
                            <a href="#" class="button button-outline-success rounded">Обращения губернатора</a>
                            <a href="#" class="button button-outline-success rounded">Указ президенты РФ №607</a>
                            <a href="#" class="button button-outline-success rounded">Документы</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="navbar-user">

                <div class="dropdown dark rounded">
                    <div class="current">
                        <div class="username">
                            Авторизован как:
                            <br>
                            <span class="post"><?= $this->user()['role']['post'] ?></span>
                        </div>
                        <div class="avatar" style="background-image: url('<?= $this->image('/assets/images/avatar.jpg'); ?>')">
                            <i class="icon-chevron-down"></i>
                        </div>
                    </div>

                    <div class="options">
                        <a class="option" href="/leader">
                            <i class="icon-user"></i> Профиль
                        </a>

                        <span class="separator"></span>

                        <a class="option danger" href="/?logout">
                            <i class="icon-log-out"></i> Выход
                        </a>
                    </div>
                </div>

            </div>

        <?php } ?>

    </div>
</nav>
