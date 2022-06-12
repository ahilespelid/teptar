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
