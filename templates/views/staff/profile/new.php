<?php include $this->layout('staff/base/head.php'); ?>

    <body>

        <?php include $this->layout('staff/menu.php'); ?>

        <div class="content">

            <?php include $this->layout('staff/header.php'); ?>

            <div class="body">

                <div class="reports-title">
                    <div class="reports-title__my-reports">
                        <div class="reports-title__my-reports__text">
                            <h1>Регистрирование сотрудника</h1>
                        </div>
                    </div>
                </div>

                <div class="registration">

                    <div class="registration__avatar">

                        <label for="registration__input__avatar">
                            <div class="registration__input__avatar__middle">
                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.4609 1H20.584C22.3754 1 23.271 1 23.8275 1.5565C24.384 2.11299 24.384 3.00866 24.384 4.8V5.92308" stroke="#535C69" stroke-linecap="round"/>
                                    <path d="M19.4609 21.9231H20.584C22.3754 21.9231 23.271 21.9231 23.8275 21.3666C24.384 20.8101 24.384 19.9144 24.384 18.1231V17" stroke="#535C69" stroke-linecap="round"/>
                                    <path d="M5.92383 1H4.80075C3.00941 1 2.11375 1 1.55725 1.5565C1.00075 2.11299 1.00075 3.00866 1.00075 4.8V5.92308" stroke="#535C69" stroke-linecap="round"/>
                                    <path d="M5.92383 21.9231H4.80075C3.00941 21.9231 2.11375 21.9231 1.55725 21.3666C1.00075 20.8101 1.00075 19.9144 1.00075 18.1231V17" stroke="#535C69" stroke-linecap="round"/>
                                    <path d="M6.70894 16.0539C7.3032 15.1962 8.1655 14.4735 9.21768 13.9673C10.2699 13.461 11.4689 13.1923 12.6932 13.1923C13.9176 13.1923 15.1165 13.461 16.1687 13.9673C17.2209 14.4735 18.0832 15.1962 18.6775 16.0539" stroke="#535C69" stroke-linecap="round"/>
                                    <circle cx="12.6923" cy="7.76921" r="3.19231" stroke="#535C69" stroke-linecap="round"/>
                                </svg>
                                <span>Вы можете загрузить изображение в формате JPG, GIF или PNG.</span>
                                <div class="choose__file">Выбрать файл</div>
                            </div>
                        </label>

                        <input type="file" id="registration__input__avatar">

                    </div>

                    <div class="registration__form">

                        <form action="" method="post">

                            <div class="registration__form__name">
                                <div class="registration__form__first">Введите ФИО</div>
                                <div class="registration__form__second">
                                    <div class="registration__form__second__first-input">
                                        <input type="text" required placeholder="Фамилия" id="second_name">
                                    </div>
                                    <div class="registration__form__second__second-input">
                                        <input type="text" required placeholder="Имя" id="first_name">
                                    </div>
                                    <div class="registration__form__second__third-input">
                                        <input type="text" required placeholder="Отчество" id="first_name">
                                    </div>
                                </div>
                            </div>

                            <div class="registration__form__extra">
                                <div class="registration__form__first">Укажите дополнительные данные</div>
                                <div class="registration__form__second">
                                    <div class="registration__form__second__first-input">
                                        <input type="text" required placeholder="Дата рождения" id="birthday">
                                    </div>
                                    <div class="registration__form__second__second-input">
                                        <input type="text" required placeholder="Должность" id="post">
                                    </div>
                                    <div class="registration__form__second__third-input">
                                        <input type="text" required placeholder="Район" id="district">
                                    </div>
                                    <div class="registration__form__second__third-input">

                                        <div class="chosen-search-off">
                                            <label for="staffGender">
                                                <select id="staffGender" name="staff_gender[]" data-placeholder="Пол">
                                                    <option value="1">Мужской</option>
                                                    <option value="0">Женский</option>
                                                </select>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="registration__form__contacts">
                                <div class="registration__form__first">Введите контактную информацию</div>
                                <div class="registration__form__second">
                                    <div class="registration__form__second__first-input">
                                        <input type="email" required placeholder="Почта" id="mail">
                                    </div>
                                    <div class="registration__form__second__second-input">
                                        <input type="text" required placeholder="Телефон" id="telephone_number">
                                    </div>
                                </div>
                            </div>

                            <div class="registration__form__footer">
                                <div class="registration__form__footer__text"></div>
                                <input type="submit" class="registration__form__footer__button" value="Зарегистрировать">
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        <script type="text/javascript" src="/build/chosen.js"></script>
        <script>
            $('#staffGender').chosen(
                {
                    width: '100%',
                    allow_single_deselect: true,
                    max_selected_options: 3,
                    no_results_text: 'Нет сотрудников по запросу:',
                }
            );
        </script>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
