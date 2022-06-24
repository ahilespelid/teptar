<div class="section">

    <h2>Складной блок</h2>

    <p class="description">
        Складной блок имеет следующие классы:
        <br>
        <br><b>chevron</b> - кнопка складного блока приобретет стрелку вверх и вниз, вверх если складной блок открыт и соответственно вниз если закрыт
        <br><b>dark</b> - тема складного блока станет темным
        <br>
        <br>
        При добавлении новых стилей в содержание складного блока, нельзя их вносить на элемент с классом <i>collapse-content</i>, а надо создать на пример новый <b>div</b> внутри данного элемента и уже на нее вносить любые изменения.
    </p>

    <div class="section-block">

        <h3>Для светлого фона</h3>

        <div class="collapse">
            <div class="collapse-button">Раскрыть скрытый текст</div>
            <div class="collapse-content">
                Скрытый текст
            </div>
        </div>

        <hr>

        <div class="collapse chevron">
            <div class="collapse-button">Раскрыть скрытый текст с шевроном</div>
            <div class="collapse-content">
                Скрытый текст
            </div>
        </div>

        <hr>

        <div class="collapse chevron">
            <div class="collapse-button button button-light rounded">Раскрыть скрытый блок кнопок с шевроном</div>
            <div class="collapse-content">
                <div style="padding: 12px">
                    <a class="button button-primary rounded">Primary</a>
                    <a class="button button-secondary rounded">Secondary</a>
                    <a class="button button-success rounded">Success</a>
                    <a class="button button-info rounded">Info</a>
                    <a class="button button-warning rounded">Warning</a>
                    <a class="button button-danger rounded">Danger</a>
                    <a class="button button-light rounded">Light</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="collapse fill rounded chevron">
            <div class="collapse-button block-padding sub-block-margin-top">Выбрать район в ручную</div>
            <div class="collapse-content sub-block-margin-top">
                <a href="#" class="item">Пункт 1</a>
                <a href="#" class="item">Пункт 2</a>
                <a href="#" class="item">Пункт 3</a>
            </div>
        </div>

    </div>

    <div class="section-block dark">

        <h3>Для темного фона</h3>

        <div class="collapse dark">
            <div class="collapse-button">Раскрыть скрытый текст</div>
            <div class="collapse-content">
                Скрытый текст
            </div>
        </div>

        <hr>

        <div class="collapse dark chevron">
            <div class="collapse-button">Раскрыть скрытый текст с шевроном</div>
            <div class="collapse-content">
                Скрытый текст
            </div>
        </div>

        <hr>

        <div class="collapse dark chevron">
            <div class="collapse-button button button-light dark rounded">Раскрыть скрытый блок кнопок с шевроном</div>
            <div class="collapse-content">
                <div style="padding: 12px">
                    <a class="button button-primary rounded">Primary</a>
                    <a class="button button-secondary rounded">Secondary</a>
                    <a class="button button-success rounded">Success</a>
                    <a class="button button-info rounded">Info</a>
                    <a class="button button-warning rounded">Warning</a>
                    <a class="button button-danger rounded">Danger</a>
                    <a class="button button-light rounded dark">Light</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="collapse dark fill rounded chevron">
            <div class="collapse-button block-box block-padding sub-block-margin-top">Выбрать район в ручную</div>
            <div class="collapse-content sub-block-margin-top">
                <a href="#" class="item">Пункт 1</a>
                <a href="#" class="item">Пункт 2</a>
                <a href="#" class="item">Пункт 3</a>
            </div>
        </div>

    </div>

</div>
