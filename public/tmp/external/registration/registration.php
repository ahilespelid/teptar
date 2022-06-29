<?php
define('_DS_', DIRECTORY_SEPARATOR);
$url = $_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="description" content="Список отчетов">
  <meta name="keywords" content="Список отчетов, Тептар, тептар">
  <link rel="stylesheet" href="/registration/assets/css/style.css">
    <script src="/jquery-3.6.0.min.js"></script>
    <!--[if IE 9]>
    <link rel="stylesheet" href="./assets/css/style-for-ie9.css">
    <![endif]-->
  <script type="text/javascript" src="<?$url;?>/registration/assets/js/reports.js"></script>
    <script type="text/javascript"  src="<?$url;?>/registration/blocks/content/body/body.js"></script>
  <script type="text/javascript" src="<?$url;?>/registration/blocks/content/body/__reports-title.js"></script>
  <script type="text/javascript"  src="<?$url;?>/registration/blocks/content/body/registration.js"></script>
  <script type="text/javascript"  src="<?$url;?>/registration/blocks/content/body/form.js"></script>
  <script type="text/javascript"  src="<?$url;?>/registration/blocks/content/body/avatar.js"></script>
  <script type="text/javascript"  src="<?$url;?>/registration/blocks/content/content.js"></script>
  <title>Регистрация сотрудника</title>
</head>
<body>

      <!-- Меню -->
      <?php  require_once dirname(__DIR__)._DS_.'reusable-blocks'._DS_.'menu'._DS_.'menu.php'; ?>
      <!-- Меню -->
      
      <div class="content">

      <!-- header -->
          <?php  require_once dirname(__DIR__)._DS_.'reusable-blocks'._DS_.'header'._DS_.'header.php'; ?>
      <!-- header -->

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
                <h1>Зарегистрировать сотрудника</h1>
              </div>
            </div>
          </div>
            <div class="registration">
                <div class="registration__avatar">
                    <label for="registration__input__avatar">
                        <div class="registration__input__avatar__middle">
                            <img src="../assets/img/svg/user_avatar.svg" alt="user_avatar">
                            <span>Вы можете загрузить изображение в формате JPG, GIF или PNG.</span>
                            <div class="choose__file">Выбрать файл</div>
                        </div>
                    </label>
                    <input type="file" id="registration__input__avatar">
                </div>
                <div class="registration__form">
                    <form>
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
                                <div class="sort-year">
                                    <span class="sort__toggle__year">
                                        <span class="sort__toggle__year__text">Пол</span>
                                        <span class="icon-arrow_drop_down dropdown-arrow"></span>
                                    </span>
                                    <div class="sort__block__year none">
                                        <div class="sort__block__element" id="male">Мужской</div>
                                        <div class="sort__block__element" id="female">Женский</div>
                                    </div>
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

</body>
</html>
