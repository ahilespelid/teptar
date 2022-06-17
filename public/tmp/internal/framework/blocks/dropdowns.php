<div class="section">

    <h2>Выпадающие списки</h2>

    <p class="description">
        Добавив следующие классы в дополнение к классе <i>dropdown</i>, выпадающий список изменит стиль/формы или приобретет новые функции:
        <br>
        <br><b>interactive</b> - кнопка открытия выпадающего списка примет значение опции при нажатии на одну из опций
        <br><b>chevron</b> - кнопка открытия выпадающего списка приобретет стрелку вверх и вниз, вверх если выпадающий список открыт и соответственно вниз если закрыт
        <br><b>rounded</b> - выпадающий список станет округленным
        <br><b>right</b> - выпадающий список будет открываться справа от кнопки открытия
        <br><b>dark</b> - тема выпадающего списка станет темным
        <br><b>divider</b> - <i>span</i> элемент в опциях с данным классом создаст разделитель
        <br><b>danger</b> - данный класс в опциях сделает текст пункта красным
        <br>
        <br>
        Кроме этого можно в кнопке открытия выпадающего списка создать <i>span</i> элемент с классом <b>title</b>, тем самым создавая именной выпадающий список.
    </p>

    <div class="section-block">

        <h3>Для светлого фона</h3>

        <div class="dropdown rounded">
            <a class="current button button-success rounded">Меню</a>

            <div class="options">
                <a class="option" href="#">✎ Редактировать</a>
                <span class="divider"></span>
                <a class="option danger" href="#">✕ Удалить</a>
            </div>
        </div>

        <div class="dropdown interactive rounded right chevron">
            <div class="current button button-dropdown rounded"><span class="title">Сравнение:</span> за предыдущий год</div>

            <div class="options">
                <span class="option">за предыдущий год</span>
                <span class="option">за последние 5 лет</span>
                <span class="option">за последний месяц</span>
            </div>
        </div>

        <div class="dropdown interactive">
            <div class="current button button-dropdown"><span class="title">Район:</span> Грозненский</div>

            <div class="options">
                <span class="option">Грозненский</span>
                <span class="option">Аргунский</span>
                <span class="option">Надтеречный</span>
            </div>
        </div>

    </div>

    <div class="section-block dark">

        <h3>Для темного фона</h3>

        <div class="dropdown rounded dark">
            <a class="current button button-success rounded">Меню</a>

            <div class="options">
                <a class="option" href="#">✎ Редактировать</a>
                <span class="divider"></span>
                <a class="option danger" href="#">✕ Удалить</a>
            </div>
        </div>

        <div class="dropdown interactive rounded right dark chevron">
            <div class="current button button-dropdown rounded"><span class="title">Сравнение:</span> за предыдущий год</div>

            <div class="options">
                <span class="option">за предыдущий год</span>
                <span class="option">за последние 5 лет</span>
                <span class="option">за последний месяц</span>
            </div>
        </div>

        <div class="dropdown interactive dark">
            <div class="current button button-dropdown"><span class="title">Район:</span> Грозненский</div>

            <div class="options">
                <span class="option">Грозненский</span>
                <span class="option">Аргунский</span>
                <span class="option">Надтеречный</span>
            </div>
        </div>

    </div>

</div>
