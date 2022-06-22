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
  <link rel="stylesheet" href="/templates/views/disclates/views/disc/assets/css/style.css">
    <script src="/assets/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="<?$url;?>/templates/views/disclates/views/disc/assets/js/reports.js"></script>
    <script type="text/javascript"  src="<?$url;?>/templates/views/disclates/views/disc/blocks/content/body/body.js"></script>
  <script type="text/javascript" src="<?$url;?>/templates/views/disclates/views/disc/blocks/content/body/__reports-title.js"></script>
  <script type="text/javascript"  src="<?$url;?>/templates/views/disclates/views/disc/blocks/content/body/disc.js"></script>
    <script type="text/javascript"  src="<?$url;?>/templates/views/disclates/views/disc/blocks/content/body/__footer.js"></script>
    <script type="text/javascript"  src="<?$url;?>/templates/views/disclates/views/disc/blocks/content/content.js"></script>
  <title>Диск</title>
</head>
<body>
    <?php  require_once dirname(__DIR__) . _DS_ . 'disc' . _DS_ . 'blocks' . _DS_ . 'content' . _DS_ . 'folderAddModal' . _DS_ . 'file_add_modal.php'; ?>

    <?php  require_once dirname(__DIR__) . _DS_ . 'disc' . _DS_ . 'blocks' . _DS_ . 'content' . _DS_ . 'fileAddModal' . _DS_ . 'file_add_modal.php'; ?>

    <!-- Меню -->
      <?php  require_once dirname(__DIR__) . _DS_ ._DS_.'menu.php'; ?>
      <!-- Меню -->
      
      <div class="content">

      <!-- header -->
          <?php  require_once dirname(__DIR__) . _DS_ ._DS_.'header.php'; ?>
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
                <h1>Диск Грозненский</h1>
              </div>
              <div class="reports-title__my-reports__btn">
                <button class="add-report-btn add_file">
                  <img src="<?$url;?>/templates/views/reportses/views/reports/assets/img/svg/add_ring_light.svg" alt="add_ring_light">
                  Добавить файл
                </button>
              </div>
                <div class="reports-title__my-reports__btn">
                    <button class="add-report-btn create_folder">
                        <img src="<?$url;?>/templates/views/reportses/views/reports/assets/img/svg/add_ring_light.svg" alt="add_ring_light">
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
                      <input class="disc__element__header__checkbox" type="checkbox">
                  </div>
                  <div class="disc__element__img">
                    <img src="../../../assets/images/svg/colored_folder.svg" alt="">
                  </div>
                  <div class="disc__element__name">Загруженные файлы</div>
              </div>
              <div class="disc__element">
                  <div class="disc__element__header">
                      <span class="icon-menu"></span>
                      <input class="disc__element__header__checkbox" type="checkbox">
                  </div>
                  <div class="disc__element__img">
                      <img src="../../../assets/images/svg/pdf.svg" alt="">
                  </div>
                  <div class="disc__element__name">Описание.pdf</div>
              </div>
              <div class="disc__element">
                  <div class="disc__element__header">
                      <span class="icon-menu"></span>
                      <input class="disc__element__header__checkbox" type="checkbox">
                  </div>
                  <div class="disc__element__img">
                      <img src="../../../assets/images/svg/word.svg" alt="">
                  </div>
                  <div class="disc__element__name">Описание.word</div>
              </div>
              <div class="disc__element">
                  <div class="disc__element__header">
                      <span class="icon-menu"></span>
                      <input class="disc__element__header__checkbox" type="checkbox">
                  </div>
                  <div class="disc__element__img">
                      <img src="../../../assets/images/svg/mp3.svg" alt="">
                  </div>
                  <div class="disc__element__name">Описание.mp3</div>
              </div>
              <div class="disc__element">
                  <div class="disc__element__header">
                      <span class="icon-menu"></span>
                      <input class="disc__element__header__checkbox" type="checkbox">
                  </div>
                  <div class="disc__element__img">
                      <img src="../../../assets/images/svg/ppt.svg" alt="">
                  </div>
                  <div class="disc__element__name">Описание.ppt</div>
              </div>
              <div class="disc__element">
                  <div class="disc__element__header">
                      <span class="icon-menu"></span>
                      <input class="disc__element__header__checkbox" type="checkbox">
                  </div>
                  <div class="disc__element__img">
                      <img src="../../../assets/images/svg/txt.svg" alt="">
                  </div>
                  <div class="disc__element__name">Описание.txt</div>
              </div>
              <div class="disc__element">
                  <div class="disc__element__header">
                      <span class="icon-menu"></span>
                      <input class="disc__element__header__checkbox" type="checkbox">
                  </div>
                  <div class="disc__element__img">
                      <img src="../../../assets/images/svg/zip.svg" alt="">
                  </div>
                  <div class="disc__element__name">Описание.zip</div>
              </div>
              <div class="disc__element">
                  <div class="disc__element__header">
                      <span class="icon-menu"></span>
                      <input class="disc__element__header__checkbox" type="checkbox">
                  </div>
                  <div class="disc__element__img">
                      <img src="../../../assets/images/svg/mov.svg" alt="">
                  </div>
                  <div class="disc__element__name">Описание.mov</div>
              </div>
          </div>
            <div class="disc-footer none">
                <div class="disc-footer__action">
                    <span class="icon-import_light"></span>
                    Скачать
                </div>
                <div class="disc-footer__count">Отмечено <span class="disc-checked"></span>/<span class="disc-count"></span></div>
            </div>
        </div>
      </div>

    <div class='black_background'></div>

</body>
</html>
