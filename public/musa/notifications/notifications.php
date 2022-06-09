<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="description" content="Список отчетов">
    <meta name="keywords" content="Список отчетов, Тептар, тептар">
    <link type="text/css" rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="../font.css">
    <script type="text/javascript"  src="./assets/js/script.js"></script>
    <script src="../jquery-3.6.0.min.js"></script>
    <script type="text/javascript"  src="./blocks/content/content.js"></script>
    <script type="text/javascript"  src="./blocks/content/body/body.js"></script>
    <script type="text/javascript"  src="./blocks/content/body/__reports-title.js"></script>
    <script type="text/javascript"  src="./blocks/content/body/__notification__notices.js"></script>
    <script type="text/javascript"  src="./blocks/content/body/__notification__districts.js"></script>
    <script type="text/javascript"  src="../reusable-blocks/menu/menu.js"></script>
    <script type="text/javascript"  src="../reusable-blocks/menu/__main.js"></script>
    <script type="text/javascript"  src="../reusable-blocks/menu/__header.js"></script>
    <script type="text/javascript"  src="../reusable-blocks/menu/__body.js"></script>
    <script type="text/javascript"  src="../reusable-blocks/menu/__footer.js"></script>
    <script type="text/javascript"  src="../reusable-blocks/header/header.js"></script>
    <script type="text/javascript"  src="../reusable-blocks/header/__main.js"></script>
  <title>Уведомления</title>
</head>
<body>

    <?php include "../reusable-blocks/menu/menu.php"; ?>

      <div class="content">

        <?php include  "../reusable-blocks/header/header.php"; ?>

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
                    <img class="notifications__districts__body__img" src="../assets/img/avatar.jpg" alt="">
                  <span class="notifications__districts__body__district">
                    <span class="notifications__districts__body__district-name">Курчалоевский Район</span>
                    <span class="notifications__districts__body__district-count">4 уведомлений</span>
                  </span>
                </div>
              </div>
            </div>
            <div class="notifications__notices">
              <div class="notifications__notices__element" style="display: none;">
                  <img class="notifications__notices__body__img" src="../assets/img/avatar.jpg" alt="">
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
