<?php include $this->layout('staff/base/head.php'); ?>

    <body>

        <?php  require_once '_folder_add_modal.php' ?>
        <?php  require_once '_file_add_modal.php' ?>

        <div class="folderload" id="rename-modal">
            <div class="fileload-modal">
                <div class="fileload-modal__header">
                    <span>Переименовать (название папки/файла)</span>
                    <img src="../assets/img/svg/xmark.svg" alt="x">
                </div>
                <div class="fileload-modal__footer">
                    <div class="fileload-modal__footer__files">
                        <input id="rename_folder" type="text" placeholder="Введите название" maxlength="40">
                    </div>
                    <div class="fileload-modal__footer__submit">
                        <div class="reports-title__my-reports__btn submit_added_folder">
                            <button class="add-report-btn">
                                <i class="icon-plus-circle"></i>
                                Переименовать
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include $this->layout('staff/menu.php'); ?>

        <div class="content">

            <?php include $this->layout('staff/header.php'); ?>

            <div class="body">
<!--                <div class="body__back-button">-->
<!--                    <a href="#">-->
<!--                        <span class="icon-expand_left_right body__back__arrow"></span>-->
<!--                        Вернуться-->
<!--                    </a>-->
<!--                </div>-->
                <div class="developer-alert">
                    <i class="icon-refresh spin"></i> Страница «Диск» на стадии разработки, пожалуйста заходите позже
                </div>
                <div class="reports-title">
                    <div class="reports-title__my-reports">
                        <div class="reports-title__my-reports__text">
                            <h1>Диск Грозненский</h1>
                        </div>
                        <div class="reports-title__my-reports__btn">
                            <button class="add-report-btn sumbit_add_file">
                                <i class="icon-document-add"></i>
                                Добавить файл
                            </button>
                        </div>
                        <div class="reports-title__my-reports__btn">
                            <button class="add-report-btn sumbit_create_folder">
                                <i class="icon-folder_alt"></i>
                                Создать папку
                            </button>
                        </div>
                    </div>
                    <!--div class="sort">
              <span class="sort__toggle">
                Сортировать по: <span class="sort__value">Году</span> <span class="icon-sort sort__icon">
              </span>
              <div class="sort__block none">
                <div class="sort__block__element"><span class="icon-folder_alt sort-element year"></span>По годам</div>
                <div class="sort__block__element"><span class="icon-save_light sort-element month"></span>По месяцам</div>
                <div class="sort__block__element"><span class="icon-save_light sort-element important"></span>По важности</div>
                <div class="sort__block__element"><span class="icon-save_light sort-element views"></span>По просмотрам</div>
              </div>
                    </div-->
                </div>
                <div class="disc">
<?php if($dirs){foreach($dirs as $dir){ ?>
                    <div class="disc__element">
                        <div class="disc__element__header">
                            <span class="icon-menu"></span>
                            <div class="dropdown__menu none">
                                <div class="dropdown__menu__element get">
                                    <!--Скачать-->
                                </div>
                                <div class="dropdown__menu__element">
                                    Переименовать
                                </div>
                                <div class="dropdown__menu__element del">
                                    Удалить
                                </div>
                            </div>
                            <!--input class="disc__element__header__checkbox" type="checkbox"-->
                        </div>
                        <div class="disc__element__img">
                            <img src="<?= $this->image($dir['img']); ?>" alt="">
                        </div>
                        <div class="disc__element__name"><?= $dir['name']; ?></div>
                    </div>
<?php }} ?>
<script type="text/javascript">
$.fn.pulse = function(options) {
    var options = $.extend({
        times: 3,
        duration: 1000
    }, options);
    var period = function(callback) {
        $(this).animate({opacity: 0}, options.duration, function() {
            $(this).animate({opacity: 1}, options.duration, callback);
        });
    };
    return this.each(function() {
        var i = +options.times, self = this,
        repeat = function() { --i && period.call(self, repeat)};
        period.call(this, repeat);
    });
}
$(document).ready(function(){
let get = $('.get'); get.css({'cursor' : 'pointer'});
let del = $('.del'); del.css({'cursor' : 'pointer'});

get.on('click', function(e){var name = $(this).attr('data-path');
$.ajax({
    url: '/disk', type: 'POST', data:  {'getFile': $(this).attr('data-path')},
    xhrFields: { responseType: 'blob' },
    success: function (data, textStatus, jqXHR){let link = document.createElement('a'), filename = name;
        if(jqXHR.getResponseHeader('Content-Disposition')){filename = jqXHR.getResponseHeader('Content-Disposition').split('='); filename = (filename) ? decodeURIComponent(escape(filename[1])) : decodeURIComponent(escape(name));}
        link.href = window.URL.createObjectURL(data); link.download = filename; link.click();
}});});
del.on('click', function(e){var name = $(this).attr('data-path');
$.ajax({
    url: '/disk', type: 'POST', data:  {'delFile': $(this).attr('data-path')},
    success: function (data, textStatus, jqXHR){
        if(jqXHR.getResponseHeader('Content-Disposition')){filename = jqXHR.getResponseHeader('Content-Disposition').split('='); filename = (filename) ? decodeURIComponent(escape(filename[1])) : decodeURIComponent(escape(name));}
        $('.disc').pulse({times: 2, duration: 150});
        console.log(data);

}});});

});
</script>
<?php if($dirs){foreach($files as $file){ ?>
                    <div class="disc__element pointer">
                        <div class="disc__element__header">
                            <span class="icon-menu"></span>
                            <div class="dropdown__menu none">
                                <div class="dropdown__menu__element get" data-path="<?= $file['path']; ?>">
                                    Скачать
                                </div>
                                <div class="dropdown__menu__element">
                                    Переименовать
                                </div>
                                <div class="dropdown__menu__element del">
                                    Удалить
                                </div>
                            </div>
                            <input class="disc__element__header__checkbox" type="checkbox">
                        </div>
                        <div class="disc__element__img">
                            <img src="<?= $this->image($file['img']); ?>" alt="">
                        </div>
                        <div class="disc__element__name"><?= $file['name']; ?></div>
                    </div>
<?php }} ?>
                </div>
                <div class="disc-footer none">
                    <div class="disc-footer__action" id="get">
                        <span class="icon-import_light"></span>
                        Скачать
                    </div>
                    <div class="disc-footer__action" id="del">
                        <span class="icon-plus-circle"></span>
                        Удалить
                    </div>
                    <div class="disc-footer__count">Отмечено <span class="disc-checked"></span>/<span class="disc-count"></span></div>
                </div>
            </div>
        </div>

        <div class='black_background'></div>

    </body>

<?php include $this->layout('staff/base/foot.php'); ?>
