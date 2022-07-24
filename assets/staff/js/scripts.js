// Блок меню

$(document).ready(function () {
    $(".menu__footer__toggle a")["0"].addEventListener("click", function () {
        $(".menu").toggleClass("menu__folded")
        let menu = document.getElementById('menu');
        if (menu.classList.contains('menu__folded')) {
            document.cookie = "menu=folded";
        } else {
            document.cookie = "menu=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        }
    })
})

// Шапка

$(document).ready(function () {
    $(".user__info").on('click', function (e) {
        e.stopPropagation()
        $(".user__dropdown-menu").toggleClass("none")
        $('.user__info__arrow').toggleClass("rotate_arrow")
    })

    $(".user__dropdown-menu__block__variables").on("click", function (e) {
        $(".user__info__arrow").toggleClass("rotate_arrow")
    })
})

// Выпадающее меню

$(document).ready(function() {

    $(".content").on("click", function() {
        $(".sort__block").addClass("none")
    })

    $(".sort").on("click", function(e) {
        e.stopPropagation()
        $(".sort__block").toggleClass("none")
    })

})

// Временные данные

// Выбрано: Район

$(document).ready(function() {
    $(".content").on("click", function(e) {
        $(".sort__block").addClass("none")
        $(".reports-footer__action__sort").addClass("none")
        $(".user__dropdown-menu").addClass("none")
    })
})

$(document).ready(function (e) {
    $(".excel").on("click", function (e) {
        $(".reports-footer__action span").first().text("Выгрузить в Excel")
    })

    $(".word").on("click", function (e) {
        $(".reports-footer__action span").first().text("Выгрузить в Word")
    })

    $(".pdf").on("click", function (e) {
        $(".reports-footer__action span").first().text("Выгрузить в PDF")
    })
})

$(document).ready(function() {
    $(".reports__body__line").each(function (i, item){
        let textForCondition = $(this).find(".reports__body__line__activity").text()

        if(textForCondition === "В работе") {
            $(this).addClass("warning")
        } else if (textForCondition === "Дорабатывается") {
            $(this).addClass("expired")
        } else if (textForCondition === "Успешно") {
            if(i % 2 !== 0) {
                $(this).addClass("finished")
            }
        }

        item.children[0].childNodes[1].addEventListener("click", function () {
            if($.makeArray($(".reports__body__checkbox")).every(function(item){ return item.checked === true })) {
                $(".reports-list__title__checkbox").prop('checked', true)
            } else {
                $(".reports-list__title__checkbox").prop('checked', false)
            }
            if($.makeArray($(".reports__body__checkbox")).some(function(item){ return item.checked === true })) {
                $(".reports").addClass("reports__decrease-height")
                $(".reports-footer").removeClass("none")
            } else {
                $(".reports").removeClass("reports__decrease-height")
                $(".reports-footer").addClass("none")
            }
            if(item.children[0].childNodes[1].checked) {
                $(item).addClass("checked")
            } else if(!item.children[0].childNodes[1].checked){
                $(item).removeClass("checked")
            }

        })
    })

    var count = 0

    $(".reports-count").text($('.reports__body__line').length)

    $(".reports__body__checkbox").each(function (i, item) {
        item.addEventListener("click", function (e) {

            if(e.target.checked) {
                count++
            } else {
                count--
            }
            $(".reports-checked").text(count)
        })
    })

    $(".reports-list__title__checkbox").on("click", function (e) {

        if(e.target.checked) {
            $(".reports__body__line").each(function(i, item) {
                item.children[0].childNodes[1].checked = true
                $(this).addClass("checked")
                $(".reports").addClass("reports__decrease-height")
                $(".reports-footer").removeClass("none")
                count = $('.reports__body__line').length
            })
        } else {
            $(".reports__body__line").each(function (i, item) {
                item.children[0].childNodes[1].checked = false
                $(this).removeClass("checked")
                $(".reports").removeClass("reports__decrease-height")
                $(".reports-footer").addClass("none")
                count = 0
            })
        }
        $(".reports-checked").text(count)
    })

    $(".reports-footer__action").on("click", function(e) {
        e.stopPropagation()
        $(".reports-footer__action__sort").toggleClass("none")
    })

})
