<?php
define('_DS_', DIRECTORY_SEPARATOR);
$url = $_SERVER['DOCUMENT_ROOT'];
?>

<div class="fileload" id="add_file">
    <div class="fileload-modal">
        <div class="fileload-modal__header">
            <span>Добавить задачу</span>
            <img src="../assets/img/svg/xmark.svg" alt="x">
        </div>
        <div class="fileload-modal__body">
            <label for="fileload-modal__input">
                <div class="fileload-modal__input__middle">
                    <img src="../assets/img/svg/file_dock.svg" alt="file_dock">
                    <div>Перетащите файл сюда</div>
                </div>
            </label>
            <input type="file" id="fileload-modal__input" multiple="true">
        </div>
        <div class="fileload-modal__footer">
            <div class="fileload-modal__footer__files">
            </div>
            <div class="fileload-modal__footer__submit">
                <div class="reports-title__my-reports__btn submit_added_files">
                    <button class="add-report-btn">
                        <img src="<?$url;?>/templates/views/reportses/views/reports/assets/img/svg/add_ring_light.svg" alt="add_ring_light">
                        Добавить загруженные файлы
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
