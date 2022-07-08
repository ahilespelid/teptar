// Color by percent

function hslColor(percent, start, end) {
    var a = percent / 100,
        b = (end - start) * a,
        c = b + start;

    return 'hsl('+c+', 60%, 56%)';
}

// Make a table sortable with class name 'sortable-table'

function sortTableByColumn(table, column, asc = true) {
    const dirModifier = asc ? 1 : -1;
    const tBody = table.tBodies[0];
    const rows = Array.from(tBody.querySelectorAll("tr"));

    // Sort each row
    const sortedRows = rows.sort(function (a, b) {
        const aColText = a.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();
        const bColText = b.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();

        return aColText > bColText ? (1 * dirModifier) : (-1 * dirModifier);
    });

    // Remove all existing TRs from the table
    while (tBody.firstChild) {
        tBody.removeChild(tBody.firstChild);
    }

    // Re-add the newly sorted rows
    tBody.append(...sortedRows);

    // Remember how the column is currently sorted
    table.querySelectorAll("th").forEach(function (th) {th.classList.remove("th-sort-asc", "th-sort-desc")});
    table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-asc", asc);
    table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-desc", !asc);
}

document.querySelectorAll(".sortable-table th").forEach(function (headerCell) {
    headerCell.addEventListener("click", function () {
        const tableElement = headerCell.parentElement.parentElement.parentElement;
        const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children, headerCell);
        const currentIsAscending = headerCell.classList.contains("th-sort-asc");

        sortTableByColumn(tableElement, headerIndex, !currentIsAscending);
    });
});

// Smooth scroll

document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Comparison

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
    if (!block.classList.contains('muted')) {
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
    }
})

// District

var mapLinks = document.querySelectorAll('.map-link');

mapLinks.forEach(function (link) {
    link.addEventListener('mouseenter', function () {
        document.querySelector('.' + link.id.replace('MapLink', '')).style.fill = '#61B252';
    })
    link.addEventListener('mouseleave', function () {
        document.querySelector('.' + link.id.replace('MapLink', '')).removeAttribute('style');
    })
});

var mapAreas = document.querySelectorAll('.chechnya-map .area');

mapAreas.forEach(function (area) {
    area.addEventListener('mouseenter', function () {
        document.getElementById('MapLink' + area.classList[1]).style.border = '1px solid #61b252';
        document.getElementById('MapLink' + area.classList[1]).style.color = '#61b252';
        area.style.fill = '#61B252';
        area.style.cursor = 'pointer';
    })
    area.addEventListener('mouseleave', function () {
        document.getElementById('MapLink' + area.classList[1]).removeAttribute('style');
        area.removeAttribute('style');
    })
    area.addEventListener('click', function () {
        document.getElementById('MapLink' + area.classList[1]).click()
    })
})
