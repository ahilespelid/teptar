<?php
define('_DS_', DIRECTORY_SEPARATOR);
$url = $_SERVER['PHP_SELF'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="description" content="Список отчетов">
  <meta name="keywords" content="Список отчетов, Тептар, тептар">
    <link type="text/css" rel="stylesheet" href="<?$url;?>/templates/views/districts/views/districts/assets/css/style.css">
    <script src="<?$url;?>/assets/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="<?$url;?>/templates/views/districts/views/districts/assets/js/script.js"></script>
  <script src="<?$url;?>/templates/views/districts/views/districts/blocks/content/body/reports.js"></script>
    <script src="<?$url;?>/templates/views/districts/views/districts/blocks/content/content.js"></script>
  <script src="<?$url;?>/templates/views/districts/views/districts/blocks/content/body/reports-title.js"></script>
  <script src="<?$url;?>/templates/views/districts/views/districts/blocks/content/body/reports-list.js"></script>
  <script src="<?$url;?>/templates/views/districts/views/districts/blocks/content/body/body.js"></script>
  <script src="<?$url;?>/templates/views/districts/views/districts/blocks/content/body/__footer.js"></script>
  <title>Список районов</title>
</head>
<body>

    <?php  require_once dirname(__DIR__) . _DS_ ._DS_.'menu.php'; ?>

      <div class="content">

          <?php  require_once dirname(__DIR__) . _DS_ ._DS_.'header.php'; ?>

        <div class="body">
          <div class="reports-title">
            <div class="reports-title__my-reports">
              <div class="reports-title__my-reports__text">
                <h1>Районы</h1>
              </div>
              <div class="reports-title__my-reports__btn">
              </div>
            </div>
            <div class="sort">
              <span class="sort__toggle">
                Сортировать по:
                <span class="sort__toggle__time">Году</span>
                <img src="<?$url;?>/templates/views/districts/views/districts/assets/img/svg/sort.svg" alt="sort">
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
                        Районы
                    </div>
                    <div class="reports-list__title__element reports-list__title__second-element">
                        Крайний срок
                    </div>
                    <div class="reports-list__title__element reports-list__title__third-element">
                        Эффективность
                    </div>
                    <div class="reports-list__title__element reports-list__title__fourth-element">
                        Участники
                    </div>
                </div>
                <div class="reports__body">

                <div class="reports__body__line" style="display: none;">
                        <div class="reports__body__line__name">
                            <span>Отчет 2021<span>
                        </div>
                        <div class="reports__body__line__activity"></div>
                        <div class="reports__body__line__term">
                          <span></span>
                        </div>
                        <div class="reports__body__line__assistant">
                            <div class="name-block">
                                <img class="reports__body__avatar">
                                <img class="reports__body__second__avatar">
                                <span class="reports__body__number"></span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
          </div>
        </div>
      </div>

</body>
</html>
