// Collapsible

var collapsibleElements = document.querySelectorAll('.collapsible');

collapsibleElements.forEach(function (block) {
    if (!block.classList.contains('muted')) {
        block.querySelector('.collapsible-button').addEventListener('click', function () {

            // Закрыть уже открытый показатель
            if (document.querySelector('.collapsible.active') && !block.classList.contains('active')) {
                var activeCollapsible = document.querySelector('.collapsible.active');
                activeCollapsible.classList.toggle('active');
                activeCollapsible.querySelector('.collapsible-content').style.maxHeight = null;
                if (document.querySelector('.collapsible.previous-open')) {
                    document.querySelector('.collapsible.previous-open').classList.toggle('previous-open');
                }
            }

            var nextElement = block.nextElementSibling;

            block.classList.toggle("active");
            var content = block.querySelector('.collapsible-content');

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
