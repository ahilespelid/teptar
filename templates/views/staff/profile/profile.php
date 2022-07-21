<?php include $this->layout('staff/base/head.php'); ?>

    <body>

        <?php include $this->layout('staff/menu.php'); ?>

        <div class="content">

            <?php include $this->layout('staff/header.php'); ?>

            <div class="body">
<!--                <div class="body__back-button">-->
<!--                    <a href="#">-->
<!--                        <span class="icon-expand_left_right body__back__arrow"></span>-->
<!--                        Вернуться-->
<!--                    </a>-->
<!--                </div>-->
                <div class="reports-title">
                    <div class="reports-title__my-reports">
                        <div class="reports-title__my-reports__text">
                            <span class="my-reports__text__profile__name"><?= $user['firstname'] ?> <?= $user['secondname'] ?> <?= $user['lastname'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="profile">
                    <div class="profile__avatar-main">
                        <div class="profile__avatar">
                            <img class="avatar" src="<?= $user['avatar'] ?>" alt="">

<!--                            --><?php //pa($currentUser) ?>

                            <?php  $role = 2; ?>

                            <?php if($role === 1) { ?>
                                <label for="profile__input__avatar">
                                    <div class="profile__input__avatar__middle">
                                        <img src="../assets/img/svg/user_avatar.svg" alt="user_avatar">
                                        <span>Вы можете загрузить изображение в формате JPG, GIF или PNG.</span>
                                        <div class="choose__file">Выбрать файл</div>
                                    </div>
                                </label>
                                <input type="file" id="profile__input__avatar">
                            <?php } ?>
                        </div>
                        <div class="profile__footer">
                            <div class="profile__footer__ministry">
                                <?php if ($uin['type'] === 'district') { ?>
                                    <span class="ministry">Район:</span>
                                <?php } ?>
                                <span class="ministry__name"><?= $uin['owner'] ?></span>
                            </div>
                            <div class="profile__footer__address">
                                <i class="icon-pin"></i>
                                <span class="address__republic">Чеченская Республика,</span>
                                <span class="address__country">Российская Федерация</span>
                            </div>
                            <div class="profile__footer__social">
                                <a href="https://<?= $user['social_in'] ?>"><i class="icon-instagram"></i></a>
                                <a href="https://<?= $user['social_tg'] ?>"><i class="icon-telegram"></i></a>
                                <a href="https://<?= $user['social_vk'] ?>"><i class="icon-vk"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="profile__form">
                        <div class="profile__form__name">
                            <div class="profile__form__first">ФИО</div>
                            <div class="profile__form__second">
                                <div class="profile__form__second__first-input">
                                    <span id="second_name">
                                        <div>Фамилия</div>
                                        <div><?= $user['lastname'] ?></div>
                                    </span>
                                </div>
                                <div class="profile__form__second__second-input">
                                    <span id="first_name">
                                        <div>Имя</div>
                                        <div><?= $user['firstname'] ?></div>
                                    </span>
                                </div>
                                <div class="profile__form__second__third-input">
                                    <span id="third_name">
                                        <div>Отчество</div>
                                        <div><?= $user['secondname'] ?></div>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <?php if($currentUser) { ?>

                            <div class="profile__form__extra">
                                <div class="profile__form__first">Дополнительные данные</div>
                                <div class="profile__form__second">
                                    <div class="profile__form__second__first-input">
                                            <span id="birthday">
                                                <div>Пол</div>
                                                <div><?= ($user['gender']) ? 'Мужской' : 'Женский' ?></div>
                                            </span>
                                    </div>
                                    <div class="profile__form__second__second-input">
                                            <span id="post">
                                                <div>Дата рождения</div>
                                                <div><?= (new DateTime($user['age']))->format('d.m.o') ?></div>
                                            </span>
                                    </div>
                                    <div class="profile__form__second__third-input">
                                            <span id="district">
                                                <div>Подразделение</div>
                                                <div><?= $uin['owner'] ?></div>
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <form>
                                <div class="profile__form__contacts">
                                    <div class="profile__form__first">Контакты</div>
                                    <div class="profile__form__second">
                                        <div class="profile__form__second__first-input">
                                            <span>
                                                <div>Почта</div>
                                                <div><input type="email" value="<?= $user['email'] ?>" id="mail" required></div>
                                            </span>
                                        </div>
                                        <div class="profile__form__second__second-input">
                                            <span>
                                                <div>Телефон</div>
                                                <div><input type="tel" value="<?= $user['phone'] ?>" id="telephone_number" required></div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile__form__social">
                                    <div class="profile__form__first">Социальные сети</div>
                                    <div class="profile__form__second">
                                        <div class="profile__form__second__first-input">
                                            <span>
                                                <div>Телеграм</div>
                                                <div><input type="text" value="<?= $user['social_tg'] ?>" id="telegram" required></div>
                                            </span>
                                        </div>
                                        <div class="profile__form__second__first-input">
                                            <span>
                                                <div>Вконтакте</div>
                                                <div><input type="text" value="<?= $user['social_vk'] ?>" id="vk" required></div>
                                            </span>
                                        </div>
                                        <div class="profile__form__second__second-input">
                                            <span>
                                                <div>Инстаграм</div>
                                                <div><input type="text" value="<?= $user['social_in'] ?>" id="instagram" required></div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile__form__footer">
                                    <input type="submit" class="profile__form__footer__button" value="Сохранить изменения">
                                    <div class="profile__form__footer__text none">
                                        <img src="../assets/img/svg/check_ring_light.svg" alt="check_ring_light">
                                        Изменения сохранены
                                    </div>
                                </div>
                            </form>

                        <?php } else { ?>

                            <div class="profile__form__contacts">
                                <div class="profile__form__first">Контакты</div>
                                <div class="profile__form__second">
                                    <div class="profile__form__second__first-input">
                                        <span id="mail">
                                            <div>Почта</div>
                                            <div><?= $user['email'] ?></div>
                                        </span>
                                    </div>
                                    <div class="profile__form__second__second-input">
                                        <span id="telephone_number">
                                            <div>Телефон</div>
                                            <div><?= $user['phone'] ?></div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="profile__form__extra">
                                <div class="profile__form__first">Дополнительные данные</div>
                                <div class="profile__form__second">
                                    <div class="profile__form__second__first-input">
                                        <span id="birthday">
                                            <div>Пол</div>
                                            <div><?= ($user['gender']) ? 'Мужской' : 'Женский' ?></div>
                                        </span>
                                    </div>
                                    <div class="profile__form__second__second-input">
                                        <span id="post">
                                            <div>Дата рождения</div>
                                            <div><?= (new DateTime($user['age']))->format('d.m.o') ?></div>
                                        </span>
                                    </div>
                                    <div class="profile__form__second__third-input">
                                        <span id="district">
                                            <div>Подразделение</div>
                                            <div><?= $uin['owner'] ?></div>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
