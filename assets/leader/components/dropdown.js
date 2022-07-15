if (document.querySelector('.dropdown')) {
    document.querySelectorAll('.dropdown').forEach(function (dropdown) {
        // Показать содержание dropdown элемента если нажать на dropdown
        dropdown.querySelector('.current').addEventListener('click', function (event) {
            event.stopPropagation();

            // Закрыть dropdown, если пользователь кликнет на другой dropdown элемент
            if (document.querySelector('.dropdown.show') && document.querySelector('.dropdown.show') !== dropdown) {
                document.querySelector('.dropdown.show').classList.toggle('show');
            }

            dropdown.classList.toggle('show');

            // Вывести dropdown список снизу вверх если расстояние между dropdown элементом и нижней границей окна меньше чем размер dropdown списка
            var bottomDistance = window.innerHeight - dropdown.getBoundingClientRect().bottom;
            var dropdownHeight = dropdown.querySelector('.options').offsetHeight;

            if (dropdownHeight > bottomDistance) {
                dropdown.classList.add('above');
                dropdown.querySelector('.options').style.bottom = 'calc(-' + bottomDistance + 'px + 10px)';
            } else if (dropdown.classList.contains('above')) {
                dropdown.classList.remove('above')
            }
        })

        // Присовение значения при нажатии на опцию из dropdown списка
        if (dropdown.classList.contains('interactive')) {
            dropdown.querySelectorAll('.options .option').forEach(function (option) {
                option.addEventListener('click',function (event) {
                    event.stopPropagation()
                    if (dropdown.querySelector('.title')) {
                        dropdown.querySelector('.current').innerHTML = '<span class="title">' + dropdown.querySelector('.title').innerHTML + '</span>' + ' ' + option.innerHTML;
                    } else {
                        dropdown.querySelector('.current').innerHTML = option.innerHTML;
                    }
                    dropdown.classList.toggle('show');
                })
            })
        }
    });

    // Закрыть dropdown, если пользователь кликнет за его пределы
    window.onclick = function (event) {
        if (document.querySelector('.dropdown.show')) {
            if (event.target.parentNode !== document.querySelector('.dropdown.show')) {
                document.querySelector('.dropdown.show').classList.toggle('show');
            }
        }
    }
}
