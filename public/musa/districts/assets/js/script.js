let content = document.querySelector(".content")
let menu = document.querySelector(".menu")
let toggle = document.querySelector(".menu__footer__toggle")
let reportsBody = document.querySelector(".reports-list__body")
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

let date = String(new Date())

console.log()

toggle.children[0].addEventListener("click", e => menu.classList.toggle("menu__folded"))

reports.map(item => {
  let tr = document.createElement("div")
  let name = document.createElement("div")
  let activity = document.createElement("div")
  let term = document.createElement("div")
  let assistant = document.createElement("div")
  let responsible = document.createElement("div")
  let efficiency = document.createElement("span")
  name.classList.add("reports-list__body__element")
  activity.classList.add("reports-list__body__element")
  term.classList.add("reports-list__body__element")
  assistant.classList.add("reports-list__body__element")
  responsible.classList.add("reports-list__body__element")
  name.innerHTML = `${item.name}`
  activity.textContent = item.activity
  if(item.assistant.length + 1 >= 2) {
    assistant.innerHTML = `
    <span class="name reports-list__more">
        <span class="reports-list__body__avatar"></span>
        <span class="reports-list__body__avatar"></span>
        +1
    </span>`
  } else {
    assistant.innerHTML = `
    <span class="name">
        <span class="reports-list__body__avatar"></span>
        <span class="reports-list__body__avatar"></span>
    </span>`
  }

  if(item.term === "В работе") {
    term.innerHTML = `<span class="warning">${item.term}</span>`
  } else if(item.term === "Дорабатывается") {
    term.innerHTML = `<span class="expired">${item.term}</span>`
  } else if(item.term === "Успешно") {
    term.innerHTML = `<span class="finished">${item.term}</span>`
  } else {
    term.innerHTML = item.term
  }

  tr.classList.add("reports-list__body__line")
  tr.prepend(name, activity, term, assistant)

  tr.append()

  reportsBody.append(tr)
})

sortToggle.addEventListener("click", e => {
  e.stopPropagation()
  sortBlock.classList.toggle("none")
})

let variables = Array.from(sortBlockElement)

content.addEventListener("click", e => {
  if(!reportsFooter.classList[1] || !sortBlock.classList[1]) {
    sortBlock.classList.add("none")
    reportsActionsVariable.classList.add("none")
    console.log("hello")
  }
})

function fixDate (date) {
  if(date === "May") {
    return "мая"
  } else if(date === "Jun"){
    return "июня"
  } else if(date === "Jul"){
    return "июля"
  } else if(date === "Aug"){
    return "августа"
  } else if(date === "Sep"){
    return "сентября"
  } else if(date === "Oct"){
    return "октября"
  } else if(date === "Nov"){
    return "ноября"
  } else if(date === "Dec"){
    return "декабря"
  } else if(date === "Jan"){
    return "января"
  } else if(date === "Feb"){
    return "февраля"
  } else if(date === "Mar"){
    return "марта"
  } else if(date === "Apr"){
    return "апреля"
  }
}
