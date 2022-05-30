let menu = document.querySelector(".menu")
let toggle = document.querySelector(".menu__footer__toggle")

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

let date = String(new Date())

toggle.children[0].addEventListener("click", e => menu.classList.toggle("menu__folded"))
