<div class="navbar-responsive">
    <div class="item">
        <div class="map">
<!--            <div class="collapse rounded dark fill">-->
<!--                <div class="collapse-button">-->
<!--                    <a class="current button button-success rounded"><i class="icon icon-map"></i> Чеченская республика</a>-->
<!--                </div>-->
<!--                <div class="collapse-content">-->
<!--                    <div class="collapse-content-list sub-block-margin-top">-->
<!--                        --><?php //foreach ($connect->getAll($districts_sql) as $district) { ?>
<!--                            <a class="item" href="/region/index.php?district=--><?//= $district['mapname'] ?><!--">--><?//= $district['name'] ?><!--</a>-->
<!--                        --><?php //} ?>
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

            <div class="item dropdown dark rounded mobile-none responsive-dropdown-map">
                <a class="current button button-success rounded"><i class="icon icon-map"></i> Чеченская республика</a>
                <div class="options">
                    <div class="dropdown-map">
                        <?php include '../blocks/map/map.php'?>
                    </div>
                </div>
            </div>

            <div class="item dropdown dark rounded only-mobile">
                <a class="current button button-success rounded"><i class="icon icon-map"></i> Чеченская республика</a>
                <div class="options" style="width: 340px;">
                    <div class="dropdown-buttons-block">
                        <?php foreach ($connect->getAll($districts_sql) as $district) { ?>
                            <a href="/region/index.php?district=<?= $district['mapname'] ?>" class="button button-outline-success rounded"><?= $district['name'] ?></a>
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
            <input type="search" name="" placeholder=" Поиск" class="input" />
        </form>
    </div>
</div>
