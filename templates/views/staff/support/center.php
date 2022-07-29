<?php include $this->layout('staff/base/head.php'); ?>

    <body>

        <?php include $this->layout('staff/menu.php'); ?>

        <div class="content">

            <?php include $this->layout('staff/header.php'); ?>

            <div class="body">

                <?php if ($type === 'district') { ?>

                    <?php include $this->layout('leader/district.php'); ?>

                <?php } else { ?>

                    <div class="grid-block column center-page">
                        <div class="grid-block-main">
                            <div class="media">
                                <div class="avatar" style="background-image: url('<?= $district['flag'] ?? $this->security->setEmptyAvatar() ?>')"></div>
                            </div>
                            <span class="title"><?= $district['owner'] ?></span>
                            <span class="muted">
                                <?php if ($district['center']) { ?>
                                <i class="icon-pin"></i> <?= $district['center'] ?>,
                                <?php } ?>
                                Российская Федерация
                            </span>
                        </div>
                        <div class="data">
                            <div class="column-item">
                                <div class="block-box block-title-box">
                                    <h3>Информация о министерстве</h3>
                                </div>
                                <?php if ($districtBoss) { ?>
                                    <div class="item">
                                        <div class="content">
                                            <span>Глава Министерства</span>
                                            <span>
                                                <a href="/profile?user=<?= $districtBoss['login'] ?>">
                                                    <?= $districtBoss['lastname'] . ' ' . $districtBoss['firstname'] . ' ' . $districtBoss['secondname'] ?>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="item">
                                    <div class="content">
                                        <span>Адрес</span>
                                        <span><?= $district['address'] ?></span>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="content">
                                        <span>Телефон</span>
                                        <span><?= $district['phone'] ?></span>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="content">
                                        <span>Население</span>
                                        <span>n/A</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

                <?php if ($staffs) { ?>

                    <div class="block-margin-top">

                        <div class="block-box block-title-box box-input break-title-input">
                            <h3>Зарегистрированные сотрудники</h3>

                            <div class="title-box-input">
                                <input type="search" name="search" placeholder=" Поиск" class="input">
                            </div>
                        </div>

                        <div class="user-boxes block-box block-padding sub-block-margin-top">

                            <?php foreach ($staffs as $staff) { ?>

                                <a class="user-box" href="/profile?user=<?= $staff['login'] ?>">
                                    <div class="user-avatar">
                                        <div class="avatar" style="background-image: url('<?= $staff['avatar'] ?? $this->security->setEmptyAvatar() ?>')"></div>
                                    </div>
                                    <div class="user-info">
                                        <span class="title"><?= $staff['lastname'] . ' ' . $staff['firstname'] ?></span>
                                        <span class="muted"><?= $staff['secondname'] ?></span>
                                    </div>
                                </a>

                            <?php } ?>

                        </div>

                    </div>

                <?php } ?>

                <?php if ($type === 'district' && $this->security->userHasRole(['ministry_boss', 'ministry_staff'])) { ?>
                    <?php include $this->layout('leader/comparison/district.php'); ?>
                <?php } ?>

            </div>

        </div>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
