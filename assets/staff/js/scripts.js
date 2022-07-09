// Блок меню

$(document).ready(function () {
    $(".menu__footer__toggle a")["0"].addEventListener("click", function () {
        $(".menu").toggleClass("menu__folded")
    })

    var path = document.location.href

    if(path.includes("notifications")) {
        $("#notifications").addClass("active")
    } else if(path.includes("disc")) {
        $("#disc").addClass("active")
    } else if(path.includes("village") || path.includes("districts")) {
        $("#districts").addClass("active")
    } else if(path.includes("reports")) {
        $("#my-reports").addClass("active")
    } else if(path.includes("registration")) {
        $("#registration").addClass("active")
    } else if(path.includes("call_center")) {
        $("#contact").addClass("active")
    } else if(path.includes("support")) {
        $("#support").addClass("active")
    }
})

// Шапка

$(document).ready(function () {

    $(".user__info__arrow").on('click', function (e) {
        e.stopPropagation()
        $(".user__dropdown-menu").toggleClass("none")
        $(this).toggleClass("rotate_arrow")
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

let reports = [
    {
        "name": "Ачхой-Мартановский",
        "activity": "30 мая 2022, 15:00",
        "term": "Дорабатывается",
        "assistant": [{
            "name": "Ибрагим Грозный",
            "avatar": "/tmp/external/assets/img/avatar.jpg"
        },
            {
                "name": "Ибрагим Грозный",
                "avatar": "/tmp/external/assets/img/avatar.jpg"
            }
        ],
        "responsible": {
            "name": "Грозный Ибрагим",
            "avatar": "/tmp/external/assets/img/avatar.jpg"
        }
    },
    {
        "name": "Грозненский",
        "activity": "30 мая 2022, 15:00",
        "term": "В работе",
        "assistant": {
            "name": "Ибрагим Грозный",
            "avatar": "/tmp/external/assets/img/avatar.jpg"
        },
        "responsible": {
            "name": "Грозный Ибрагим",
            "avatar": "/tmp/external/assets/img/avatar.jpg"
        }
    },
    {
        "name": "Шалинский",
        "activity": "30 мая 2022, 15:00",
        "term": "Успешно",
        "assistant": {
            "name": "Ибрагим Грозный",
            "avatar": "/tmp/external/assets/img/avatar.jpg"
        },
        "responsible": {
            "name": "Грозный Ибрагим",
            "avatar": "/tmp/external/assets/img/avatar.jpg"
        }
    },
    {
        "name": "Ножай-Юртовский",
        "activity": "30 мая 2022, 15:00",
        "term": "В работе",
        "assistant": [{
            "name": "Ибрагим Грозный",
            "avatar": "/tmp/external/assets/img/avatar.jpg"
        },
            {
                "name": "Ибрагим Грозный",
                "avatar": "/tmp/external/assets/img/avatar.jpg"
            },
            {
                "name": "Ибрагим Грозный",
                "avatar": "/tmp/external/assets/img/avatar.jpg"
            },
            {
                "name": "Ибрагим Грозный",
                "avatar": "/tmp/external/assets/img/avatar.jpg"
            },
            {
                "name": "Ибрагим Грозный",
                "avatar": "/tmp/external/assets/img/avatar.jpg"
            }
        ],
        "responsible": {
            "name": "Грозный Ибрагим",
            "avatar": "/tmp/external/assets/img/avatar.jpg"
        }
    },
    {
        "name": "Урус-Мартановский",
        "activity": "30 мая 2022, 15:00",
        "term": "В работе",
        "assistant": {
            "name": "Ибрагим Грозный",
            "avatar": "/tmp/external/assets/img/avatar.jpg"
        },
        "responsible": {
            "name": "Грозный Ибрагим",
            "avatar": "/tmp/external/assets/img/avatar.jpg"
        }
    },
    {
        "name": "Шатойский",
        "activity": "30 мая 2022, 15:00",
        "term": "В работе",
        "assistant": {
            "name": "Ибрагим Грозный",
            "avatar": "/tmp/external/assets/img/avatar.jpg"
        },
        "responsible": {
            "name": "Грозный Ибрагим",
            "avatar": "/tmp/external/assets/img/avatar.jpg"
        }
    },
    {
        "name": "Шаройский",
        "activity": "30 мая 2022, 15:00",
        "term": "В работе",
        "assistant": [{
            "name": "Ибрагим Грозный",
            "avatar": "/tmp/external/assets/img/avatar.jpg"
        },
            {
                "name": "Ибрагим Грозный",
                "avatar": "/tmp/external/assets/img/avatar.jpg"
            },
            {
                "name": "Ибрагим Грозный",
                "avatar": "/tmp/external/assets/img/avatar.jpg"
            },
            {
                "name": "Ибрагим Грозный",
                "avatar": "/tmp/external/assets/img/avatar.jpg"
            },
        ],
        "responsible": {
            "name": "Грозный Ибрагим",
            "avatar": "/tmp/external/assets/img/avatar.jpg"
        }
    },
    {
        "name": "Щелковской",
        "activity": "30 мая 2022, 15:00",
        "term": "В работе",
        "assistant": {
            "name": "Ибрагим Грозный",
            "avatar": "/tmp/external/assets/img/avatar.jpg"
        },
        "responsible": {
            "name": "Грозный Ибрагим",
            "avatar": "/tmp/external/assets/img/avatar.jpg"
        }
    },
    {
        "name": "Грозный",
        "activity": "30 мая 2022, 15:00",
        "term": "В работе",
        "assistant": {
            "name": "Ибрагим Грозный",
            "avatar": "/tmp/external/assets/img/avatar.jpg"
        },
        "responsible": {
            "name": "Грозный Ибрагим",
            "avatar": "/tmp/external/assets/img/avatar.jpg"
        }
    },
]
