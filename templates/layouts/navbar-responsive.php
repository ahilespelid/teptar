<div class="navbar-responsive">
    <div class="item">
        <div class="map">

            <?php if (isset($navbar) && $navbar == 'home') { ?>
                <div class="map">
                    <a href="#districtsMap" class="current button button-success rounded"><i class="icon icon-map"></i> Чеченская республика</a>
                </div>
            <?php } else { ?>
                <div class="item dropdown dark rounded mobile-none responsive-dropdown-map">
                    <a class="current button button-success rounded"><i class="icon icon-map"></i> Чеченская республика</a>
                    <div class="options">
                        <div class="dropdown-map">
                            <?php include $this->layout('map/map.php'); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="item dropdown dark rounded only-mobile">
                <a class="current button button-success rounded"><i class="icon icon-map"></i> Чеченская республика</a>
                <div class="options" style="width: 340px;">
                    <div class="dropdown-buttons-block">
                        <?php foreach ($districts as $map_district) { ?>
                            <a href="/district?district=<?= $map_district['slug'] ?>" class="button button-outline-success rounded"><?= $map_district['owner'] ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="documentation">
            <div class="item dropdown right dark rounded">
                <a class="current button button-light dark upper rounded"><i class="icon icon-map"></i> Документация</a>

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
    </div>
    <div class="item search">
        <form class="navbar-search" action="" method="post">
            <input type="search" name="" placeholder=" Поиск" class="input" />
        </form>
    </div>
</div>
