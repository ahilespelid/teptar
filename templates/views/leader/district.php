<?php include $this->layout('leader/base/head.php'); ?>

    <body>

        <?php include $this->layout('leader/navbar.php'); ?>

        <div class="container">

            <div class="main">
                <?php include $this->layout('leader/navbar-responsive.php'); ?>

                <?php include $this->layout('leader/district.php'); ?>

                <?php if ($districtStaffs) { ?>

                    <div class="block-margin-top">

                        <div class="block-box block-title-box box-input break-title-input">
                            <h3>Зарегистрированные сотрудники</h3>

<!--                            <div class="title-box-input">-->
<!--                                <input type="search" name="search" placeholder=" Поиск" class="input">-->
<!--                            </div>-->
                        </div>

                        <div class="user-boxes block-box block-padding sub-block-margin-top">

                            <?php foreach ($districtStaffs as $key => $districtStaff) { ?>

                                <a class="user-box" href="/staff?district=<?= $district['slug'] ?>&login=<?= $districtStaff['login'] ?>">
                                    <div class="user-avatar">
                                        <div class="avatar" style="background-image: url('<?= $districtStaff['avatar'] ?? $this->security->setEmptyAvatar('dark') ?>')"></div>
                                    </div>
                                    <div class="user-info">
                                        <span class="title"><?= $districtStaff['lastname'] . ' ' . $districtStaff['firstname'] ?></span>
                                        <span class="muted"><?= $districtStaff['secondname'] ?></span>
                                    </div>
                                </a>

                            <?php } ?>

                        </div>

                    </div>

                <?php } ?>

<!--                --><?php //include '../blocks/comparison/district-comparison.php';?>
                <?php include $this->layout('leader/actions.php'); ?>
            </div>

        </div>

        <?php include $this->layout('leader/footer.php'); ?>

    </body>

<?php include $this->layout('leader/base/foot.php'); ?>
