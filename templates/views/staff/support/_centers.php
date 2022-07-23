<div class="reports-list">
    <div class="reports-list__title">
        <div class="reports-list__title__element">
            Название министерства
        </div>
        <div class="reports-list__title__element">
            <i class="icon-pin" style="font-size: 12px;"></i>
            Адрес
        </div>
        <div class="reports-list__title__element">
            <i class="icon-phone" style="font-size: 12px;"></i>
            Телефон
        </div>
        <div class="reports-list__title__element">
            <i class="icon-envelope" style="font-size: 12px;"></i>
            Почта
        </div>
        <div class="reports-list__title__element">
            <i class="icon-world" style="font-size: 12px;"></i>
            Сайт
        </div>
    </div>
    <div class="reports__body">

        <?php $i = 1 ?>

        <?php foreach ($centers as $center) { ?>

            <div class="reports__body__line<?php if ($i == 1) {echo ' active';} ?>" id="center<?= $center['id'] ?>">
                <div class="reports__body__line__name">
                    <span>
                        <a href="/center?center=<?= $center['slug'] ?>">
                            <?= $center['owner'] ?>
                        </a>
                    <span>
                    <span class="spinner"></span>
                </div>

                <div class="reports__body__line__activity">
                    <?= $center['address'] ?>
                </div>

                <div class="reports__body__line__term">
                    <?= $center['phone'] ?>
                </div>

                <div class="reports__body__line__assistant">
                    <div class="name-block">
                        <span class="name">
                            <?= $center['email'] ?>
                        </span>
                    </div>
                </div>

                <div class="reports__body__line__responsible">
                    <div class="name-block">
                        <span class="name">
                            <?= $center['website'] ?>
                        </span>
                    </div>
                </div>
            </div>

            <?php $i += 1 ?>

        <?php } ?>

    </div>
</div>
