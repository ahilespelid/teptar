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
  <link type="text/css" rel="stylesheet" href="<?$url;?>/templates/views/villagees/views/village/assets/css/style.css">
  <script src="<?$url;?>/templates/assets/jquery-3.6.0.min.js"></script>
  <!--[if lte IE 10]>
    <link rel="stylesheet" href=<?$url;?>"/templates/views/villagees/views/village/assets/css/style-for-ie9.css">
    <![endif]-->
  <script type="text/javascript" src="<?$url;?>/templates/views/villagees/views/village/assets/js/script.js"></script>
  <script type="text/javascript"  src="<?$url;?>/templates/views/villagees/views/village/blocks/content/body/body.js"></script>
  <script type="text/javascript" src="<?$url;?>/templates/views/villagees/views/village/blocks/content/body/__reports-title.js"></script>
  <script type="text/javascript"  src="<?$url;?>/templates/views/villagees/views/village/blocks/content/body/__reports.js"></script>
  <script type="text/javascript"  src="<?$url;?>/templates/views/villagees/views/village/blocks/content/body/__reports-footer.js"></script>
  <script type="text/javascript"  src="<?$url;?>/templates/views/villagees/views/village/blocks/content/content.js"></script>
  <title>Район</title>
</head>
<body>

      <?php  require_once dirname(__DIR__) . _DS_ ._DS_.'menu.php'; ?>

      <div class="content">

          <?php  require_once dirname(__DIR__) . _DS_ ._DS_.'header.php'; ?>

        <div class="body">
          <div class="body__back-button">
            <a href="#">
              <img width="16" height="16" src="<?$url;?>/assets/img/svg/expand_left_right.svg" alt="&#8249">
              Вернуться к списку районов
            </a>
          </div>
          <div class="reports-title">
            <div class="reports-title__my-reports">
              <div class="reports-title__my-reports__text">
                <h1>Грозный</h1>
              </div>
              <div class="reports-title__my-reports__btn">
              </div>
            </div>
            <div class="sort">
              <span class="sort__toggle">
                Сортировать по:
                <span class="sort__toggle__time">Году</span>
                <img src="<?$url;?>/assets/img/svg/sort.svg">
              </span>
                <div class="sort__block none">
                    <div class="sort__block__element"><span class="icon-folder_alt sort-element"></span>По годам</div>
                    <div class="sort__block__element"><span class="icon-save_light sort-element"></span>По месяцам</div>
                    <div class="sort__block__element"><span class="icon-save_light sort-element"></span>По важности</div>
                    <div class="sort__block__element"><span class="icon-save_light sort-element"></span>По просмотрам</div>
                </div>
            </div>
          </div>
          <div class="reports">
            <div class="reports-list">
                <div class="reports-list__title">
                  <div class="reports-list__title__element">
                    <input type="checkbox" class="reports-list__title__checkbox">
                    <img class="report-table-header-img" src="<?$url;?>/assets/img/svg/setting.svg" alt="setting">
                    Название
                  </div>
                  <div class="reports-list__title__element">
                    Эффективность
                  </div>
                  <div class="reports-list__title__element">
                    Крайний срок
                  </div>
                  <div class="reports-list__title__element">
                    Помощник
                  </div>
                  <div class="reports-list__title__element">
                    Ответственный
                  </div>
            </div>
              <div class="reports__body">

              <div class="reports__body__line" style="display: none;">
                        <div class="reports__body__line__name">
                            <input type="checkbox" id="checkbox-0" class="reports__body__checkbox">
                            <i class="icon-menu reports__body__i"></i>
                            <span>Отчет 2021<span>
                        </div>
                        <div class="reports__body__line__activity"></div>
                        <div class="reports__body__line__term"></div>
                        <div class="reports__body__line__assistant">
                            <div class="name-block">
                                <img class="reports__body__avatar"><span class="name"></span>
                            </div>
                        </div>
                        <div class="reports__body__line__responsible">
                            <div class="name-block">
                                <img src="assets/img/avatar.jpg" class="reports__body__avatar"><span class="name"></span>
                            </div>
                        </div>
                    </div>

              </div>
            </div>
          </div>
          <div class="reports-footer none">
              <div class="reports-footer__action">
                Выгрузить
                <div class="reports-footer__action__sort none">
                  <div class="variables" value="excel">
                    <img width="30" height="30" src="<?$url;?>/assets/img/svg/xlsx.svg">
                    Выгрузить в Excel
                  </div>
                  <div class="variables" value="word">
                    <img width="30" height="30" src="<?$url;?>/assets/img/svg/word.svg">
                    Выгрузить в Word
                  </div>
                  <div class="variables" value="pdf">
                    <img width="30" height="30" src="<?$url;?>/assets/img/svg/pdf.svg">
                    Выгрузить в PDF
                  </div>
                </div>
<!--                <img width="24" height="24" src="../assets/img/svg/arrow_drop_down_black.svg" alt="&#x2193">-->
                  <span class="icon-arrow_drop_down dropdown-arrow"></span>
              </div>
              <div class="reports-footer__submit__button">
                <button>Применить</button>
              </div>
              <div class="reports-footer__count">Отмечено <span class="reports-checked"></span>/<span class="reports-count"></span></div>
          </div>
        </div>
      </div>

</body>
</html>
