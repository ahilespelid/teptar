// Создание цвета для индикатора эффективности и добавление элементов верстки
document.querySelectorAll('.districts-score-table').forEach(function (table) {
    // Создание цвета из диапазона двух цветов для индикатора эффективности в зависимовсти от процента
    table.querySelectorAll('.table-progress-bar').forEach((bar) => {
        bar.querySelector('.table-progress-bar-gradient').innerHTML = bar.style.width;
        bar.style.backgroundColor = hslColor(bar.style.width.replace('%',''),0,120);
    })

    // Добавление элементов 'separator' для улучшения верстки
    table.querySelector('thead tr').insertAdjacentHTML('afterbegin','<th class="separator"></th>');
    table.querySelector('thead tr').insertAdjacentHTML('beforeend','<th class="separator"></th>');
    table.querySelectorAll('tbody tr').forEach((row) => {
        row.insertAdjacentHTML('afterbegin','<td class="separator"></td>');
    })
    table.querySelectorAll('tbody tr').forEach((row) => {
        row.insertAdjacentHTML('beforeend','<td class="separator"></td>');
    })
});

var collapseIndicatorElements = document.querySelectorAll('.collapse-indicator');

collapseIndicatorElements.forEach(function (block) {
    block.querySelector('.collapse-indicator-button').addEventListener('click', function () {

        // Закрыть уже открытый показатель
        if (document.querySelector('.collapse-indicator.active') && !block.classList.contains('active')) {
            var activeCollapseIndicator = document.querySelector('.collapse-indicator.active');
            activeCollapseIndicator.classList.toggle('active');
            activeCollapseIndicator.querySelector('.collapse-indicator-content').style.maxHeight = null;
            if (document.querySelector('.collapse-indicator.previous-open')) {
                document.querySelector('.collapse-indicator.previous-open').classList.toggle('previous-open');
            }
        }

        var nextElement = block.nextElementSibling;

        block.classList.toggle("active");
        var content = block.querySelector('.collapse-indicator-content');

        if (content.style.maxHeight){
            if (nextElement) {
                nextElement.classList.remove('previous-open');
            }
            content.style.maxHeight = null;
        } else {
            if (nextElement) {
                nextElement.classList.add('previous-open');
            }
            content.style.maxHeight = content.scrollHeight + "px";
        }
    })
})
