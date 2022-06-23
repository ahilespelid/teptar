<?php
define('_DS_', DIRECTORY_SEPARATOR);
$url = $_SERVER['DOCUMENT_ROOT'];
?>

<link rel="stylesheet" href="menu.css">
<script src="<?$url;?>/assets/jquery-3.6.0.min.js"></script>
<script type="text/javascript"  src="<?$url;?>/templates/layouts/menunu/menu.js"></script>
<script type="text/javascript"  src="<?$url;?>/templates/layouts/menunu/__main.js"></script>
<script type="text/javascript"  src="<?$url;?>/templates/layouts/menunu/__header.js"></script>
<script type="text/javascript"  src="<?$url;?>/templates/layouts/menunu/__body.js"></script>
<script type="text/javascript"  src="<?$url;?>/templates/layouts/menunu/__footer.js"></script>

<div class="menu" id="menu">
    <div class="menu__main">
        <div class="menu__header">
            <img src="<?$url;?>/assets/images/logo.svg" alt="logo">
            <div class="menu__header__text"><b>ОЦЕНКА ЭФФЕКТИВНОСТИ</b> ОРГАНОВ МЕСТНОГО САМОУПРАВЛЕНИЯ</div>
        </div>
        <nav class="menu__body">
            <div class="menu__body__list">
                <a href="/?ex=reports#" id="districts"><span class="icon-archive menu-icon"></span><span>Районы</span></a>
                <a href="#" id="disc"><span class="icon-save_light menu-icon"></span><span>Диск</span></a>
                <a href="/?ex=notifications#" id="notifications"><span class="icon-notifications menu-icon notif-icon"></span><span>Уведомления</span></a>
            </div>
            <div class="menu__body__list">
                <a href="#" id="support"><span class="icon-setting menu-icon"></span><span>Служба поддержки</span></a>
                <a href="#" id="contact"><span class="icon-darhboard_alt menu-icon"></span><span>Контакт-центр</span></a>
                <a href="#" id="profile"><span class="icon-user menu-icon"></span><span>Профиль</span></a>
            </div>
        </nav>
        <div class="menu__footer">
          <span class="menu__footer__toggle">
            <a>
              <span class="icon-toggle toggle-icon"></span>
              <span class="menu__footer__text">
                Свернуть панель
              </span>
            </a>
          </span>
      </div>
    </div>
</div>