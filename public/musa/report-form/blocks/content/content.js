document.addEventListener("DOMContentLoaded", (e) => {

  let content = document.querySelector(".content")
  let sortBlock = document.querySelector(".sort__block")
  let sortBlockMonth = document.querySelector(".sort__block__month")
  let sortBlockYear = document.querySelector(".sort__block__year")

  content.addEventListener("click", e => {
    if (!sortBlock.classList[1]) {
      sortBlock.classList.add("none")
    }
    if (!sortBlockYear.classList[1]) {
      sortBlockYear.classList.add("none")
    }
    if (!sortBlockMonth.classList[1]) {
      sortBlockMonth.classList.add("none")
    }
  })
})
