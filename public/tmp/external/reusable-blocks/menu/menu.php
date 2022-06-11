<?php $url = $GLOBALS['path']['use']['ex'];
use App\Registr;
?>
<div class="menu" id="menu">
    <div class="menu__main">
        <div class="menu__header">
            <img src="<?=$url;?>/assets/img/teptar.svg">
            <div class="menu__header__text">ОЦЕНКА ЭФФЕКТИВНОСТИ ОРГАНОВ МЕСТНОГО САМОУПРАВЛЕНИЯ</div>
        </div>
        <nav class="menu__body">
            <div class="menu__body__list">
                <a href="/?ex=reports#" id="my-reports"><span class="icon-archive menu-icon"></span><span>Мои отчеты</span></a>
                <a href="#" id="disc"><span class="icon-save_light menu-icon"></span><span>Диск</span></a>
                <a href="/?ex=notifications#" id="notifications"><span class="icon-notifications menu-icon"></span><span>Уведомления</span></a>
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