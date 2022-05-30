document.addEventListener("DOMContentLoaded", (e) => {
  let sortToggle = document.querySelector(".sort__toggle")
  let sortToggleMonth = document.querySelector(".sort__toggle__month")
  let sortToggleYear = document.querySelector(".sort__toggle__year")
  let sortBlock = document.querySelector(".sort__block")
  let sortBlockMonth = document.querySelector(".sort__block__month")
  let sortBlockYear = document.querySelector(".sort__block__year")

  sortToggle.addEventListener("click", e => {
    e.stopPropagation()
    sortBlock.classList.toggle("none")
    sortBlockMonth.classList.add("none")
    sortBlockYear.classList.add("none")
  })

  sortToggleMonth.addEventListener("click", e => {
    e.stopPropagation()
    sortBlockMonth.classList.toggle("none")
    sortBlockYear.classList.add("none")
    sortBlock.classList.add("none")
  })

  sortToggleYear.addEventListener("click", e => {
    e.stopPropagation()
    sortBlockYear.classList.toggle("none")
    sortBlockMonth.classList.add("none")
    sortBlock.classList.add("none")
  })
})
