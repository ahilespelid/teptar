let content = document.querySelector(".content")
let menu = document.querySelector(".menu")
let toggle = document.querySelector(".menu__footer__toggle")
let sortToggle = document.querySelector(".sort__toggle")
let sortBlock = document.querySelector(".sort__block")
let sortToggleMonth = document.querySelector(".sort__toggle__month")
let sortBlockMonth = document.querySelector(".sort__block__month")
let sortToggleYear = document.querySelector(".sort__toggle__year")
let sortBlockYear = document.querySelector(".sort__block__year")
let sortBlockElement = document.querySelectorAll(".sort__block__element")

toggle.children[0].addEventListener("click", e => menu.classList.toggle("menu__folded"))

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


let variables = Array.from(sortBlockElement)

content.addEventListener("click", e => {
  if(!sortBlock.classList[1]) {
    sortBlock.classList.add("none")
  }
  if(!sortBlockYear.classList[1]) {
    sortBlockYear.classList.add("none")
  }
  if(!sortBlockMonth.classList[1]) {
    sortBlockMonth.classList.add("none")
  }
})
