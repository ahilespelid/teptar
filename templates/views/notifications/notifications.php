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
    <link type="text/css" rel="stylesheet" href="<?$url;?>/templates/views/notificationsws/notifications/assets/css/style.css">
    <script type="text/javascript" src="<?$url;?>/templates/views/notificationsws/notifications/assets/js/script.js"></script>
    <script src="<?$url;?>/templates/assets/jquery-3.6.0.min.js"></script>
    <script type="text/javascript"  src="<?$url;?>/templates/views/notificationsws/notifications/blocks/content/content.js"></script>
    <script type="text/javascript"  src="<?$url;?>/templates/views/notificationsws/notifications/blocks/content/body/body.js"></script>
    <script type="text/javascript"  src="<?$url;?>/templates/views/notificationsws/notifications/blocks/content/body/__reports-title.js"></script>
    <script type="text/javascript"  src="<?$url;?>/templates/views/notificationsws/notifications/blocks/content/body/__notification__notices.js"></script>
    <script type="text/javascript"  src="<?$url;?>/templates/views/notificationsws/notifications/blocks/content/body/__notification__districts.js"></script>
  <title>Уведомления</title>
</head>
<body>

      <?php  require_once dirname(__DIR__) . _DS_ ._DS_.'menu.php'; ?>

      <div class="content">

          <?php  require_once dirname(__DIR__) . _DS_ ._DS_.'header.php'; ?>

        <div class="body">
          <div class="reports-title">
            <div class="reports-title__my-reports">
              <div class="reports-title__my-reports__text">
                <h1>Уведомления</h1>
              </div>
            </div>
          </div>
          <div class="notifications">
            <div class="notifications__districts">
              <div class="notifications__districts__header">
                Список районов
              </div>
              <div class="notifications__districts__body">
                <div class="notifications__districts__body__element">
                    <img class="notifications__districts__body__img" src="<?$url;?>/assets/img/avatar.jpg" alt="avatar">
                  <span class="notifications__districts__body__district">
                    <span class="notifications__districts__body__district-name">Курчалоевский Район</span>
                    <span class="notifications__districts__body__district-count">4 уведомлений</span>
                  </span>
                </div>
              </div>
            </div>
            <div class="notifications__notices">
              <div class="notifications__notices__element" style="display: none;">
                  <img class="notifications__notices__body__img" src="<?$url;?>/assets/img/avatar.jpg" alt="avatar">
                  <div class="notifications__notices__text">
                      <span class="notifications__notices__text__name">Курчалоевский район</span>
                      <span class="notifications__notices__text__status">Добавлена задача</span>
                  </div>
                  <div class="notifications__notices__element__date">
                      Сегодня 19:04
                      <span class="notifications__notices__delete">
                          <!-- <img src="../assets/img/svg/xmark.svg" alt="x"> -->
                      </span>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>

</body>
</html>
