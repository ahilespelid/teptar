let content = document.querySelector(".content")
let menu = document.querySelector(".menu")
let toggle = document.querySelector(".menu__footer__toggle")
let reportsFooter = document.querySelector(".reports-footer")
let reportsActionsVariable = document.querySelector(".reports-footer__action__sort")
let sortToggle = document.querySelector(".sort__toggle")
let sortBlock = document.querySelector(".sort__block")
let sortBlockElement = document.querySelectorAll(".sort__block__element")

let reports = [
  {
    "name": "Грозный",
    "activity": "2021-12-21",
    "term": "Дорабатывается",
    "assistant": [{
      "name": "Ибрагим Грозный",
      "avatar": "../assets/img/avatar.jpg"
      },
      {
        "name": "Ибрагим Грозный",
        "avatar": "../assets/img/avatar.jpg"
      }
    ],
    "responsible": {
      "name": "Грозный Ибрагим",
      "avatar": "../assets/img/avatar.jpg"
    }
  },
  {
    "name": "Грозный",
    "activity": "30 мая 2022, 15:00",
    "term": "В работе",
    "assistant": {
      "name": "Ибрагим Грозный",
      "avatar": "../assets/img/avatar.jpg"
    },
    "responsible": {
      "name": "Грозный Ибрагим",
      "avatar": "../assets/img/avatar.jpg"
    }
  },
  {
    "name": "Грозный",
    "activity": "2021-12-21",
    "term": "Успешно",
    "assistant": {
      "name": "Ибрагим Грозный",
      "avatar": "../assets/img/avatar.jpg"
    },
    "responsible": {
      "name": "Грозный Ибрагим",
      "avatar": "../assets/img/avatar.jpg"
    }
  },
  {
    "name": "Грозный",
    "activity": "2021-12-21",
    "term": "В работе",
    "assistant": [{
      "name": "Ибрагим Грозный",
      "avatar": "../assets/img/avatar.jpg"
    },
      {
        "name": "Ибрагим Грозный",
        "avatar": "../assets/img/avatar.jpg"
      }
    ],
    "responsible": {
      "name": "Грозный Ибрагим",
      "avatar": "../assets/img/avatar.jpg"
    }
  },
  {
    "name": "Грозный",
    "activity": "2021-12-21",
    "term": "В работе",
    "assistant": {
      "name": "Ибрагим Грозный",
      "avatar": "../assets/img/avatar.jpg"
    },
    "responsible": {
      "name": "Грозный Ибрагим",
      "avatar": "../assets/img/avatar.jpg"
    }
  },
  {
    "name": "Грозный",
    "activity": "2021-12-21",
    "term": "В работе",
    "assistant": {
      "name": "Ибрагим Грозный",
      "avatar": "../assets/img/avatar.jpg"
    },
    "responsible": {
      "name": "Грозный Ибрагим",
      "avatar": "../assets/img/avatar.jpg"
    }
  },
  {
    "name": "Грозный",
    "activity": "2021-12-21",
    "term": "В работе",
    "assistant": {
      "name": "Ибрагим Грозный",
      "avatar": "../assets/img/avatar.jpg"
    },
    "responsible": {
      "name": "Грозный Ибрагим",
      "avatar": "../assets/img/avatar.jpg"
    }
  },
  {
    "name": "Грозный",
    "activity": "2021-12-21",
    "term": "В работе",
    "assistant": {
      "name": "Ибрагим Грозный",
      "avatar": "../assets/img/avatar.jpg"
    },
    "responsible": {
      "name": "Грозный Ибрагим",
      "avatar": "../assets/img/avatar.jpg"
    }
  },
  {
    "name": "Грозный",
    "activity": "2021-12-21",
    "term": "В работе",
    "assistant": {
      "name": "Ибрагим Грозный",
      "avatar": "../assets/img/avatar.jpg"
    },
    "responsible": {
      "name": "Грозный Ибрагим",
      "avatar": "../assets/img/avatar.jpg"
    }
  },
]


