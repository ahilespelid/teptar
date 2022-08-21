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

                    <div class="registration__form">

                        <form action="" method="post" enctype="multipart/form-data">

                            <div class="registration__avatar">

                                <label for="registration__input__avatar" class="output-content">
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

                                <input type="file" name="avatar[]" id="registration__input__avatar" class="custom-file-input" required>

                            </div>

                            <div class="registration__info">

                                <div class="registration__form__name">
                                    <div class="registration__form__first">Введите ФИО</div>
                                    <div class="registration__form__second">
                                        <div class="registration__form__second__first-input">
                                            <label for="last_name"></label>
                                            <input type="text" name="lastname" placeholder="Фамилия" id="last_name" required>
                                        </div>
                                        <div class="registration__form__second__second-input">
                                            <label for="first_name"></label>
                                            <input type="text" name="firstname" placeholder="Имя" id="first_name" required>
                                        </div>
                                        <div class="registration__form__second__third-input">
                                            <label for="second_name"></label>
                                            <input type="text" name="secondname" placeholder="Отчество" id="second_name" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="registration__form__name">
                                    <div class="registration__form__first">Укажите дополнительные данные</div>
                                    <div class="registration__form__second">
                                        <div class="registration__form__second__first-input">
                                            <label for="login"></label>
                                            <input type="text" name="login" placeholder="Логин" id="login" required>
                                        </div>
                                        <div class="registration__form__second__second-input">
                                            <label for="age"></label>
                                            <input type="date" name="age" placeholder="Дата рождения" id="age" required>
                                        </div>
                                        <div class="registration__form__second__third-input">

                                            <div class="chosen-search-off">
                                                <label for="gender">
                                                    <select id="gender" name="gender" data-placeholder="Пол">
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
                                            <label for="email"></label>
                                            <input type="email" name="email" placeholder="Почта" id="email" required>
                                        </div>
                                        <div class="registration__form__second__second-input">
                                            <label for="phone"></label>
                                            <input type="text" name="phone" placeholder="Телефон" id="phone" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="registration__form__footer">
                                    <div class="registration__form__footer__text"></div>
                                    <input type="submit" class="registration__form__footer__button" value="Зарегистрировать">
                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        <script type="text/javascript" src="/build/chosen.js"></script>
        <script>
            $('#gender').chosen(
                {
                    width: '100%',
                    allow_single_deselect: true,
                    max_selected_options: 3,
                    no_results_text: 'Нет сотрудников по запросу:',
                }
            );

            // Image on change
            if (document.querySelector('.custom-file-input')) {
                let fileInput = document.querySelector('.custom-file-input');
                if (document.querySelector('.output-content')) {
                    let outputContent = document.querySelector('.output-content');
                    fileInput.onchange = () => {
                        outputContent.style.backgroundImage = 'url(\'' + window.URL.createObjectURL(fileInput.files[0]) + '\')';
                        outputContent.innerHTML = '';
                    };
                }
            }
        </script>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
