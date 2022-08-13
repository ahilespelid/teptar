<div class="fileload" id="add_file">
    <div class="fileload-modal">
        <div class="fileload-modal__header">
            <span>Добавить задачу</span>
            <i class="icon-cross pointer"></i>
        </div>
        <div class="fileload-modal__body">
            <label for="fileload-modal__input">
                <div class="fileload-modal__input__middle">
                    <img src="<?= $this->image('/assets/images/staff/file_dock.svg'); ?>" alt="file_dock">
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
                    <div class="reports-title__my-reports__error"></div>
                    <button class="add-report-btn">
                        <i class="icon-plus-circle"></i>
                        Добавить загруженные файлы
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
