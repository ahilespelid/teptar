<?php include $this->layout('staff/base/head.php'); ?>

    <body>

        <?php include $this->layout('staff/menu.php'); ?>

        <div class="content">

            <?php include $this->layout('staff/header.php'); ?>

            <div class="body report-table">
                <div class="developer-alert">
                    <i class="icon-refresh spin"></i> Страница «Сводная таблица» на стадии разработки, пожалуйста заходите позже
                </div>

                <div class="body__back-button">
                    <a href="#">
                        <span class="icon-expand_left_right body__back__arrow"></span>
                        Вернуться
                    </a>
                    <div class="body__back-button__tables">
                        <a href="" class="finished__table">
                            <span class="icon-archive"></span>
                            Общая таблица
                        </a>
                        <a href="" class="pivot__table">
                            <span class="icon-save_light"></span>
                            Сводная таблица
                        </a>
                    </div>
                </div>

                <div class="reports-title">
                    <div class="reports-title__my-reports">
                        <div class="reports-title__my-reports__text">
                            <h1>Грозный: Таблица 2022</h1>
                        </div>
                        <div class="reports-title__my-reports__btn">
                        </div>
                    </div>
                </div>

                <div class="table">
                    <table class="table__main">
                        <thead class="table__main__header">
                        <tr>
                            <td>#</td>
                            <td id="description__title">Показатели</td>
                            <td id="unit__title">Ед. измерения</td>
                            <td id="ministry__title">Ведомство</td>
                            <td id="district__title">Район</td>
                            <td id="dropdown__title">Действие</td>
                            <td id="status__title">Итог</td>
                        </tr>
                        </thead>
                            <?php
                            $role = 1
                            ?>
                        <tbody>
                        <tr>
                            <td class="number">1</td>
                            <td class="description">Число субъектов малого и среднего предпринимательства в расчете на 10 тыс. человек населения</td>
                            <td class="unit">Единиц</td>
                            <?php

                            if($role === 1) {
                                echo '<td class="ministry red"><input readonly type="text" value="19"></td>
                            <td class="district green"><input autofocus type="text" value="19"></td>';
                            } elseif($role === 2) {
                                echo '<td class="ministry green"><input autofocus type="text" value="19"></td>
                            <td class="district red"><input readonly type="text" value="19"></td>';
                            }

                            ?>
                            <td class="dropdown">
                                <?php
                                if($role === 1) {
                                    echo '<div class="dropdown__menu">
                                <span class="text">Выберите действие</span>
                                <span class="icon-arrow_drop_down arrow-icon"></span>
                            </div>
                            <div class="dropdown__menu__variables none">
                                <div class="dropdown__menu__variables__element on-agreed">На согласовании</div>
                                <div class="dropdown__menu__variables__element agreed">Согласовано</div>
                            </div>';
                                } else {
                                    echo '<div class="dropdown__menu__none">
                                <span class="text">Согласовано</span>
                                <span class="icon-arrow_drop_down arrow-icon"></span>
                            </div>';
                                }
                                ?>
                            </td>
                            <td class="status">
                                <input class="status__final" value="19">
                            </td>
                        </tr>
                        <tr>
                            <td class="number">1</td>
                            <td class="description">Число субъектов малого и среднего предпринимательства в расчете на 10 тыс. человек населения</td>
                            <td class="unit">Единиц</td>
                            <?php

                            if($role === 1) {
                                echo '<td class="ministry red"><input readonly type="text" value="19"></td>
                            <td class="district green"><input autofocus type="text" value="19"></td>';
                            } elseif($role === 2) {
                                echo '<td class="ministry green"><input autofocus type="text" value="19"></td>
                            <td class="district red"><input readonly type="text" value="19"></td>';
                            }

                            ?>
                            <td class="dropdown">
                                <?php
                                if($role === 1) {
                                    echo '<div class="dropdown__menu">
                                <span class="text">Выберите действие</span>
                                <span class="icon-arrow_drop_down arrow-icon"></span>
                            </div>
                            <div class="dropdown__menu__variables none">
                                <div class="dropdown__menu__variables__element on-agreed">На согласовании</div>
                                <div class="dropdown__menu__variables__element agreed">Согласовано</div>
                            </div>';
                                } else {
                                    echo '<div class="dropdown__menu">
                                <span class="text">Выберите действие</span>
                                <span class="icon-arrow_drop_down arrow-icon"></span>
                            </div>';
                                }
                                ?>
                            </td>
                            <td class="status">
                                Действие не выбрано
                            </td>
                        </tr>
                        <tr>
                            <td class="number">1</td>
                            <td class="description">Число субъектов малого и среднего предпринимательства в расчете на 10 тыс. человек населения</td>
                            <td class="unit">Единиц</td>
                            <?php

                            if($role === 1) {
                                echo '<td class="ministry red"><input readonly type="text" value="19"></td>
                            <td class="district green"><input autofocus type="text" value="19"></td>';
                            } elseif($role === 2) {
                                echo '<td class="ministry green"><input autofocus type="text" value="19"></td>
                            <td class="district red"><input readonly type="text" value="19"></td>';
                            }

                            ?>
                            <td class="dropdown">
                                <?php
                                if($role === 1) {
                                    echo '<div class="dropdown__menu">
                                <span class="text">Выберите действие</span>
                                <span class="icon-arrow_drop_down arrow-icon"></span>
                            </div>
                            <div class="dropdown__menu__variables none">
                                <div class="dropdown__menu__variables__element on-agreed">На согласовании</div>
                                <div class="dropdown__menu__variables__element agreed">Согласовано</div>
                            </div>';
                                } else {
                                    echo '<div class="dropdown__menu">
                                <span class="text">Выберите действие</span>
                                <span class="icon-arrow_drop_down arrow-icon"></span>
                            </div>';
                                }
                                ?>
                            </td>
                            <td class="status">
                                Действие не выбрано
                            </td>
                        </tr>
                        <tr>
                            <td class="number">1</td>
                            <td class="description">Число субъектов малого и среднего предпринимательства в расчете на 10 тыс. человек населения</td>
                            <td class="unit">Единиц</td>
                            <?php

                            if($role === 1) {
                                echo '<td class="ministry red"><input readonly type="text" value="19"></td>
                            <td class="district green"><input autofocus type="text" value="19"></td>';
                            } elseif($role === 2) {
                                echo '<td class="ministry green"><input autofocus type="text" value="19"></td>
                            <td class="district red"><input readonly type="text" value="19"></td>';
                            }

                            ?>
                            <td class="dropdown">
                                <?php
                                if($role === 1) {
                                    echo '<div class="dropdown__menu">
                                <span class="text">Выберите действие</span>
                                <span class="icon-arrow_drop_down arrow-icon"></span>
                            </div>
                            <div class="dropdown__menu__variables none">
                                <div class="dropdown__menu__variables__element on-agreed">На согласовании</div>
                                <div class="dropdown__menu__variables__element agreed">Согласовано</div>
                            </div>';
                                } else {
                                    echo '<div class="dropdown__menu">
                                <span class="text">Выберите действие</span>
                                <span class="icon-arrow_drop_down arrow-icon"></span>
                            </div>';
                                }
                                ?>
                            </td>
                            <td class="status">
                                Действие не выбрано
                            </td>
                        </tr>
                        <tr>
                            <td class="number">1</td>
                            <td class="description">Число субъектов малого и среднего предпринимательства в расчете на 10 тыс. человек населения</td>
                            <td class="unit">Единиц</td>
                            <?php

                            if($role === 1) {
                                echo '<td class="ministry red"><input readonly type="text" value="19"></td>
                            <td class="district green"><input autofocus type="text" value="19"></td>';
                            } elseif($role === 2) {
                                echo '<td class="ministry green"><input autofocus type="text" value="19"></td>
                            <td class="district red"><input readonly type="text" value="19"></td>';
                            }

                            ?>
                            <td class="dropdown">
                                <?php
                                if($role === 1) {
                                    echo '<div class="dropdown__menu">
                                <span class="text">Выберите действие</span>
                                <span class="icon-arrow_drop_down arrow-icon"></span>
                            </div>
                            <div class="dropdown__menu__variables none">
                                <div class="dropdown__menu__variables__element on-agreed">На согласовании</div>
                                <div class="dropdown__menu__variables__element agreed">Согласовано</div>
                            </div>';
                                } else {
                                    echo '<div class="dropdown__menu">
                                <span class="text">Выберите действие</span>
                                <span class="icon-arrow_drop_down arrow-icon"></span>
                            </div>';
                                }
                                ?>
                            </td>
                            <td class="status">
                                Действие не выбрано
                            </td>
                        </tr>
                        <tr>
                            <td class="number">1</td>
                            <td class="description">Число субъектов малого и среднего предпринимательства в расчете на 10 тыс. человек населения</td>
                            <td class="unit">Единиц</td>
                            <?php

                            if($role === 1) {
                                echo '<td class="ministry red"><input readonly type="text" value="19"></td>
                            <td class="district green"><input autofocus type="text" value="19"></td>';
                            } elseif($role === 2) {
                                echo '<td class="ministry green"><input autofocus type="text" value="19"></td>
                            <td class="district red"><input readonly type="text" value="19"></td>';
                            }

                            ?>
                            <td class="dropdown">
                                <?php
                                if($role === 1) {
                                    echo '<div class="dropdown__menu">
                                <span class="text">Выберите действие</span>
                                <span class="icon-arrow_drop_down arrow-icon"></span>
                            </div>
                            <div class="dropdown__menu__variables none">
                                <div class="dropdown__menu__variables__element on-agreed">На согласовании</div>
                                <div class="dropdown__menu__variables__element agreed">Согласовано</div>
                            </div>';
                                } else {
                                    echo '<div class="dropdown__menu">
                                <span class="text">Выберите действие</span>
                                <span class="icon-arrow_drop_down arrow-icon"></span>
                            </div>';
                                }
                                ?>
                            </td>
                            <td class="status">
                                Действие не выбрано
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table__footer none">
                    <button class="table__footer__button">Сохранить изменения</button>
                </div>
            </div>
        </div>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
