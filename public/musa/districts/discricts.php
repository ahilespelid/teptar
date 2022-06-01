<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="description" content="Список отчетов">
  <meta name="keywords" content="Список отчетов, Тептар, тептар">
  <link type="text/css" rel="stylesheet" href="./assets/css/style.css">
  <script type="text/javascript" src="./assets/js/script.js"></script>
  <script src="../reusable-blocks/menu/menu.js"></script>
  <script src="../reusable-blocks/menu/__main.js"></script>
  <script src="../reusable-blocks/menu/__header.js"></script>
  <script src="../reusable-blocks/menu/__body.js"></script>
  <script src="../reusable-blocks/menu/__footer.js"></script>
  <script src="../reusable-blocks/header/header.js"></script>
  <script src="../reusable-blocks/header/__main.js"></script>
  <script src="blocks/content/body/reports.js"></script>
  <script src="blocks/content/body/reports-title.js"></script>
  <script src="blocks/content/body/reports-list.js"></script>
  <script src="blocks/content/body/body.js"></script>
  <script src="blocks/content/body/__footer.js"></script>
  <script src="assets/js/script.js"></script>
  <title>Список районов</title>
</head>
<body>

      <?php include "../reusable-blocks/menu/menu.php";?>
      <div class="content">
        <?php include "../reusable-blocks/header/header.php";?>
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
                <img src="../assets/img/svg/sort.svg">
              </span>
              <div class="sort__block none">
                <div class="sort__block__element"><img src="../assets/img/svg/folder_alt.svg">По годам</div>
                <div class="sort__block__element"><img src="../assets/img/svg/save.svg">По месяцам</div>
                <div class="sort__block__element"><img src="../assets/img/svg/save.svg">По важности</div>
                <div class="sort__block__element"><img src="../assets/img/svg/save.svg">По просмотрам</div>
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
                <div class="reports-list__body">
                </div>
            </div>
          </div>
          <div class="reports-footer none">
              <div class="reports-footer__action">
                Выгрузить
                <div class="reports-footer__action__sort none">
                  <div class="variables" value="pdf">Выгрузить в PDF</div>
                  <div class="variables" value="pdf">Выгрузить в Excel</div>
                </div>
                <img width="24" height="24" src="../assets/img/svg/arrow_drop_down_black.svg" alt="&#x2193">
              </div>
              <div class="reports-footer__submit__button">
                <button>Применить</button>
              </div>
            <div class="reports-footer__count"></div>
          </div>
        </div>
      </div>

</body>
</html>
