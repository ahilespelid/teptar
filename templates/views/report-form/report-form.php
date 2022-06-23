<?php
define('_DS_', DIRECTORY_SEPARATOR);
$url = $_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="description" content="Форма создания отчета">
  <script src="<?$url;?>/assets/jquery-3.6.0.min.js"></script>
  <!--[if lte IE 11]>
    <link rel="stylesheet" href="assets/css/style-for-ie9.css">
    <![endif]-->
  <meta name="keywords" content="Список отчетов, Тептар, тептар">
  <link type="text/css" rel="stylesheet" href="<?$url;?>/templates/views/report-formiews/report-form/assets/css/style.css">
  <script src="<?$url;?>/templates/views/report-formiews/report-form/blocks/content/body/body.js"></script>
  <script src="<?$url;?>/templates/views/report-formiews/report-form/blocks/content/body/reports-title.js"></script>
  <script src="<?$url;?>/templates/views/report-formiews/report-form/blocks/content/body/reports-form.js"></script>
  <script src="<?$url;?>/templates/views/report-formiews/report-form/blocks/content/body/__body.js"></script>
  <script src="<?$url;?>/templates/views/report-formiews/report-form/blocks/content/body/__footer.js"></script>
  <script src="<?$url;?>/templates/views/report-formiews/report-form/blocks/content/content.js"></script>
  <title>Создание отчета</title>
</head>
<body>

    <?php  require_once dirname(__DIR__) . _DS_ ._DS_.'menu.php'; ?>

      <div class="content">

          <?php  require_once dirname(__DIR__) . _DS_ ._DS_.'header.php'; ?>

        <div class="body">
          <div class="body__back-button">
            <a href="#">
              <span class="icon-expand_left_right body__back__arrow"></span>
              Вернуться
            </a>
            <div class="body__back-button__icons">
              <a href="#">
              <span class="body__back-button__icon">
                <span class="icon-trophy"></span>
                Рейтинг
              </span>
              </a>
              <a href="#">
              <span class="body__back-button__icon">
                <span class="icon-save_light"></span>
                Диск
              </span>
              </a>
            </div>
          </div>
          <div class="reports-title">
            <div class="reports-title__my-reports">
              <div class="reports-title__my-reports__text">
                <h1>Отчет 2022</h1>
              </div>
              <div class="reports-title__my-reports__btn">
              </div>
            </div>
            <div class="sort">
              <span class="sort__toggle">
                Шаблоны отчетов
                <span class="icon-arrow_drop_down dropdown-arrow"></span>
              </span>
              <div class="sort__block none">
                <div class="sort__block__element">Отчет</div>
              </div>
            </div>
          </div>
          <div class="reports-form">
            <div class="reports-form__header">
              <div class="sort-month">
              <span class="sort__toggle__month">
                Месяц отчета
                <span class="icon-arrow_drop_down dropdown-arrow"></span>
              </span>
                <div class="sort__block__month none">
                  <div class="sort__block__element">Отчет</div>
                </div>
              </div>
              <div class="sort-year">
              <span class="sort__toggle__year">
                Год отчета
                <span class="icon-arrow_drop_down dropdown-arrow"></span>
              </span>
                <div class="sort__block__year none">
                  <div class="sort__block__element">Отчет</div>
                </div>
              </div>
            </div>
            <div class="reports-form__body">
              <textarea class="reports-form__body__textarea"></textarea>
              <div class="reports-form__body__icons">
                <a href="#">
                <div class="reports-form__body__icon">
                  <img src="<?$url;?>/assets/images/svg/import_light.svg" alt="import_light">
                  Файл
                </div>
                </a>
              </div>
            </div>
            <div class="reports-form__footer">
              <div class="reports-form__footer__first-block">
                <div class="reports-form__footer__first-block__element">
                  <span class="reports-form__footer__assistant">Помощник</span>
                  <div class="first-block__element__worker">
                    <div class="blue-button">
                      <span>Руслан Грозный<img width="12" height="12" src="<?$url;?>/assets/images/svg/light/rename_light.svg" alt="rename_light"></span>
                    </div>
                    <div class="clear-button">
                      <span><img width="12" height="12" src="<?$url;?>/assets/images/svg/rename.svg" alt="rename">Добавить еще</span>
                    </div>
                  </div>
                </div>
                <div class="reports-form__footer__first-block__element">
                  <span>Таблица</span>
                  <div class="first-block__element__add">
                    <div class="add-button">Добавить таблицу <img src="<?$url;?>/assets/images/svg/light/rename_light.svg" alt="rename_light"></div>
                  </div>
                </div>

              </div>
              <div class="reports-form__footer__submit">
                <div class="reports-form__footer__submit__buttons">
                  <div class="add-report-btn">
                    <img src="<?$url;?>/assets/images/svg/add_ring_light.svg" alt="add_ring_light">
                    Создать отчет
                  </div>
                  <div class="cancel-report-btn">
                    <img src="<?$url;?>/assets/images/svg/rename.svg" alt="rename">
                    Отмена
                  </div>
                </div>
                <div class="reports-form__footer__save__buttons">
                  <input type="checkbox">
                  Сохранить как шаблон
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


</body>
</html>
