document.addEventListener("DOMContentLoaded", (e) => {

  let sortToggle = document.querySelector(".sort__toggle")
  let sortBlock = document.querySelector(".sort__block")

  sortToggle.addEventListener("click", e => {
    e.stopPropagation()
    sortBlock.classList.toggle("none")
  })

})
