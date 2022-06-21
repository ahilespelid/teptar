<?php
define('_DS_', DIRECTORY_SEPARATOR);
$url = $_SERVER['DOCUMENT_ROOT'];
?>

<div class="folderload" id="add_folder">
    <div class="fileload-modal">
        <div class="fileload-modal__header">
            <span>Добавить задачу</span>
            <img src="../assets/img/svg/xmark.svg" alt="x">
        </div>
        <div class="fileload-modal__footer">
            <div class="fileload-modal__footer__files">
                <input type="text" placeholder="Введите название" maxlength="40">
            </div>
            <div class="fileload-modal__footer__submit">
                <div class="reports-title__my-reports__btn submit_added_folder">
                    <button class="add-report-btn">
                        <img src="<?$url;?>/templates/views/reportses/views/reports/assets/img/svg/add_ring_light.svg" alt="add_ring_light">
                        Создать папку
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
