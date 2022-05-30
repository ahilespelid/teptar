let content = document.querySelector(".content")
let menu = document.querySelector(".menu")
let toggle = document.querySelector(".menu__footer__toggle")
let reportsBlock = document.querySelector(".reports")
let reportsBody = document.querySelector(".reports-list__body")
let reportsFooter = document.querySelector(".reports-footer")
let reportsActions = document.querySelector(".reports-footer__action")
let reportsActionsVariable = document.querySelector(".reports-footer__action__sort")
let sortToggle = document.querySelector(".sort__toggle")
let sortBlock = document.querySelector(".sort__block")
let sortBlockElement = document.querySelectorAll(".sort__block__element")
let reportsFooterCount = document.querySelector(".reports-footer__count")

let reports = [
  {
    "name": "Отчет 2021",
    "activity": "2021-12-21",
    "term": "15 июнь 2022, 15:00",
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
    "name": "Отчет 2021",
    "activity": "В работе",
    "term": "30 мая 2022, 15:00",
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
    "name": "Отчет 2021",
    "activity": "2021-12-21",
    "term": "15 июнь 2022, 15:00",
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
    "name": "Отчет 2021",
    "activity": "2021-12-21",
    "term": "15 июнь 2022, 15:00",
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
    "name": "Отчет 2021",
    "activity": "2021-12-21",
    "term": "25 июнь 2022, 15:00",
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
    "name": "Отчет 2021",
    "activity": "2021-12-21",
    "term": "15 май 2022, 15:00",
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
    "name": "Отчет 2021",
    "activity": "2021-12-21",
    "term": "28 июнь 2022, 15:00",
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
    "name": "Отчет 2021",
    "activity": "2021-12-21",
    "term": "15 июнь 2022, 15:00",
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
    "name": "Отчет 2021",
    "activity": "2021-12-21",
    "term": "15 июнь 2022, 15:00",
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
  let footer = document.createElement("div")
  name.classList.add("reports-list__body__element")
  activity.classList.add("reports-list__body__element")
  term.classList.add("reports-list__body__element")
  assistant.classList.add("reports-list__body__element")
  responsible.classList.add("reports-list__body__element")
  name.innerHTML = `<input type="checkbox" class="reports-list__body__checkbox"><img class="reports-list__body__img" width="20" height="20" src="../assets/img/svg/menu.svg">${item.name}`
  activity.textContent = item.activity
  term.textContent = item.term
  assistant.innerHTML = `<span class="name"><span class="reports-list__body__avatar"></span>${item.assistant.name}</span>`
  responsible.innerHTML = `<span class="name"><span class="reports-list__body__avatar"></span>${item.responsible.name}</span>`

  let condition = Number(item.term.substring(7, 11)) == Number(date.substring(11, 16))

  let secondCondition = Number(item.term.substring(0, 3)) - Number(date.substring(8, 10))

  if(condition && item.term.substring(3, 6) == fixDate(date.substring(4, 7)) && secondCondition < 7 && secondCondition > 0) {
    tr.classList.add("warning")
  } else if(condition && secondCondition < 0) {
    tr.classList.add("expired")
  }

  tr.classList.add("reports-list__body__line")
  tr.prepend(name, activity, term, assistant, responsible)

  tr.append()

  reportsBody.append(tr)
})

let checkbox = document.querySelectorAll(".reports-list__body__checkbox")

let firstCheckbox = document.querySelector(".reports-list__title__checkbox")

let checkboxArray = Array.from(checkbox)

firstCheckbox.addEventListener("click", (e) => {
  if(firstCheckbox.checked) {
    checkboxArray.map(item => {
      item.checked = true
      reportsFooter.classList.remove("none")
      item.parentNode.parentNode.classList.add("checked")
      reportsBlock.classList.add("reports__decrease-height")
    })
  } else {
    checkboxArray.map(item => {
      item.checked = false
      reportsFooter.classList.add("none")
      item.parentNode.parentNode.classList.remove("checked")
      reportsBlock.classList.remove("reports__decrease-height")
    })
  }
  }
)

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

checkboxArray.map(item => {
  item.addEventListener("click", (e) => {
    if(checkboxArray.every(item => item.checked === true)) {
      firstCheckbox.checked = true
    } else {
      firstCheckbox.checked = false
      reportsBlock.classList.remove("reports__decrease-height")
    }
    if(checkboxArray.some(item => item.checked === true)) {
      reportsBlock.classList.add("reports__decrease-height")
      reportsFooter.classList.remove("none")
    } else {
      reportsBlock.classList.remove("reports__decrease-height")
      reportsFooter.classList.add("none")
    }
    e.path[2].classList.toggle("checked")
  })
})

reportsFooterCount.textContent = `Отмечено 2/${reports.length}`

reportsActions.addEventListener("click", (e) => {
  e.stopPropagation()
  reportsActions.children[0].classList.toggle("none")
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
