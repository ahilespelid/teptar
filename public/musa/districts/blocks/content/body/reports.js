document.addEventListener("DOMContentLoaded", (e) => {

  let reportsBody = document.querySelector(".reports-list__body")

  reports.map(item => {
    let tr = document.createElement("div")
    let name = document.createElement("div")
    let activity = document.createElement("div")
    let term = document.createElement("div")
    let assistant = document.createElement("div")
    let responsible = document.createElement("div")
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

    reportsBody.append(tr)
  })

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
