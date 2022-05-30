document.addEventListener("DOMContentLoaded", (e) => {
  let menu = document.querySelector(".menu")
  let toggle = document.querySelector(".menu__footer__toggle")

  toggle.children[0].addEventListener("click", e => menu.classList.toggle("menu__folded"))

})
