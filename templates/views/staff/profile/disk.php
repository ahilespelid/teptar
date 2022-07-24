<?php include $this->layout('staff/base/head.php'); ?>

    <body>

        <?php  require_once '_folder_add_modal.php' ?>
        <?php  require_once '_file_add_modal.php' ?>

        <div class="folderload" id="rename-modal">
            <div class="fileload-modal">
                <div class="fileload-modal__header">
                    <span>Переименовать (название папки/файла)</span>
                    <img src="../assets/img/svg/xmark.svg" alt="x">
                </div>
                <div class="fileload-modal__footer">
                    <div class="fileload-modal__footer__files">
                        <input id="rename_folder" type="text" placeholder="Введите название" maxlength="40">
                    </div>
                    <div class="fileload-modal__footer__submit">
                        <div class="reports-title__my-reports__btn submit_added_folder">
                            <button class="add-report-btn">
                                <i class="icon-plus-circle"></i>
                                Переименовать
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include $this->layout('staff/menu.php'); ?>

        <div class="content">

            <?php include $this->layout('staff/header.php'); ?>

            <div class="body">
                <div class="body__back-button">
                    <a href="#">
                        <span class="icon-expand_left_right body__back__arrow"></span>
                        Вернуться
                    </a>
                </div>
                <div class="reports-title">
                    <div class="reports-title__my-reports">
                        <div class="reports-title__my-reports__text">
                            <h1>Диск Грозненский</h1>
                        </div>
                        <div class="reports-title__my-reports__btn">
                            <button class="add-report-btn add_file">
                                <i class="icon-document-add"></i>
                                Добавить файл
                            </button>
                        </div>
                        <div class="reports-title__my-reports__btn">
                            <button class="add-report-btn create_folder">
                                <i class="icon-folder_alt"></i>
                                Создать папку
                            </button>
                        </div>
                    </div>
                    <div class="sort">
              <span class="sort__toggle">
                Сортировать по: <span class="sort__value">Году</span> <span class="icon-sort sort__icon">
              </span>
              <div class="sort__block none">
                <div class="sort__block__element"><span class="icon-folder_alt sort-element year"></span>По годам</div>
                <div class="sort__block__element"><span class="icon-save_light sort-element month"></span>По месяцам</div>
                <div class="sort__block__element"><span class="icon-save_light sort-element important"></span>По важности</div>
                <div class="sort__block__element"><span class="icon-save_light sort-element views"></span>По просмотрам</div>
              </div>
                    </div>
                </div>
                <div class="disc">
                    <div class="disc__element">
                        <div class="disc__element__header">
                            <span class="icon-menu"></span>
                            <div class="dropdown__menu none">
                                <div class="dropdown__menu__element">
                                    Скачать
                                </div>
                                <div class="dropdown__menu__element">
                                    Переименовать
                                </div>
                                <div class="dropdown__menu__element">
                                    Удалить
                                </div>
                            </div>
                            <input class="disc__element__header__checkbox" type="checkbox">
                        </div>
                        <div class="disc__element__img">
                            <img src="<?= $this->image('/assets/images/staff/folder.svg'); ?>" alt="">
                        </div>
                        <div class="disc__element__name">Загруженные файлы</div>
                    </div>
                    <div class="disc__element">
                        <div class="disc__element__header">
                            <span class="icon-menu"></span>
                            <div class="dropdown__menu none">
                                <div class="dropdown__menu__element">
                                    Скачать
                                </div>
                                <div class="dropdown__menu__element">
                                    Переименовать
                                </div>
                                <div class="dropdown__menu__element">
                                    Удалить
                                </div>
                            </div>
                            <input class="disc__element__header__checkbox" type="checkbox">
                        </div>
                        <div class="disc__element__img">
                            <img src="<?= $this->image('/assets/images/staff/pdf.svg'); ?>" alt="">
                        </div>
                        <div class="disc__element__name">Описание.pdf</div>
                    </div>
                    <div class="disc__element">
                        <div class="disc__element__header">
                            <span class="icon-menu"></span>
                            <div class="dropdown__menu none">
                                <div class="dropdown__menu__element">
                                    Скачать
                                </div>
                                <div class="dropdown__menu__element">
                                    Переименовать
                                </div>
                                <div class="dropdown__menu__element">
                                    Удалить
                                </div>
                            </div>
                            <input class="disc__element__header__checkbox" type="checkbox">
                        </div>
                        <div class="disc__element__img">
                            <img src="<?= $this->image('/assets/images/staff/word.svg'); ?>" alt="">
                        </div>
                        <div class="disc__element__name">Описание.word</div>
                    </div>
                    <div class="disc__element">
                        <div class="disc__element__header">
                            <span class="icon-menu"></span>
                            <div class="dropdown__menu none">
                                <div class="dropdown__menu__element">
                                    Скачать
                                </div>
                                <div class="dropdown__menu__element">
                                    Переименовать
                                </div>
                                <div class="dropdown__menu__element">
                                    Удалить
                                </div>
                            </div>
                            <input class="disc__element__header__checkbox" type="checkbox">
                        </div>
                        <div class="disc__element__img">
                            <img src="<?= $this->image('/assets/images/staff/mp3.svg'); ?>" alt="">
                        </div>
                        <div class="disc__element__name">Описание.mp3</div>
                    </div>
                    <div class="disc__element">
                        <div class="disc__element__header">
                            <span class="icon-menu"></span>
                            <div class="dropdown__menu none">
                                <div class="dropdown__menu__element">
                                    Скачать
                                </div>
                                <div class="dropdown__menu__element">
                                    Переименовать
                                </div>
                                <div class="dropdown__menu__element">
                                    Удалить
                                </div>
                            </div>
                            <input class="disc__element__header__checkbox" type="checkbox">
                        </div>
                        <div class="disc__element__img">
                            <img src="<?= $this->image('/assets/images/staff/ppt.svg'); ?>" alt="">
                        </div>
                        <div class="disc__element__name">Описание.ppt</div>
                    </div>
                    <div class="disc__element">
                        <div class="disc__element__header">
                            <span class="icon-menu"></span>
                            <div class="dropdown__menu none">
                                <div class="dropdown__menu__element">
                                    Скачать
                                </div>
                                <div class="dropdown__menu__element">
                                    Переименовать
                                </div>
                                <div class="dropdown__menu__element">
                                    Удалить
                                </div>
                            </div>
                            <input class="disc__element__header__checkbox" type="checkbox">
                        </div>
                        <div class="disc__element__img">
                            <img src="<?= $this->image('/assets/images/staff/txt.svg'); ?>" alt="">
                        </div>
                        <div class="disc__element__name">Описание.txt</div>
                    </div>
                    <div class="disc__element">
                        <div class="disc__element__header">
                            <span class="icon-menu"></span>
                            <div class="dropdown__menu none">
                                <div class="dropdown__menu__element">
                                    Скачать
                                </div>
                                <div class="dropdown__menu__element">
                                    Переименовать
                                </div>
                                <div class="dropdown__menu__element">
                                    Удалить
                                </div>
                            </div>
                            <input class="disc__element__header__checkbox" type="checkbox">
                        </div>
                        <div class="disc__element__img">
                            <img src="<?= $this->image('/assets/images/staff/zip.svg'); ?>" alt="">
                        </div>
                        <div class="disc__element__name">Описание.zip</div>
                    </div>
                    <div class="disc__element">
                        <div class="disc__element__header">
                            <span class="icon-menu"></span>
                            <div class="dropdown__menu none">
                                <div class="dropdown__menu__element">
                                    Скачать
                                </div>
                                <div class="dropdown__menu__element">
                                    Переименовать
                                </div>
                                <div class="dropdown__menu__element">
                                    Удалить
                                </div>
                            </div>
                            <input class="disc__element__header__checkbox" type="checkbox">
                        </div>
                        <div class="disc__element__img">
                            <img src="<?= $this->image('/assets/images/staff/mov.svg'); ?>" alt="">
                        </div>
                        <div class="disc__element__name">Описание.mov</div>
                    </div>
                </div>
                <div class="disc-footer none">
                    <div class="disc-footer__action">
                        <span class="icon-import_light"></span>
                        Скачать
                    </div>
                    <div class="disc-footer__action">
                        <span class="icon-plus-circle"></span>
                        Удалить
                    </div>
                    <div class="disc-footer__count">Отмечено <span class="disc-checked"></span>/<span class="disc-count"></span></div>
                </div>
            </div>
        </div>

        <div class='black_background'></div>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
