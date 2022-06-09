document.addEventListener("DOMContentLoaded", (e) => {
  var menu = document.querySelector(".menu")
  var toggle = document.querySelector(".menu__footer__toggle")

  toggle.children[0].addEventListener("click", e => menu.classList.toggle("menu__folded"))

})
