document.addEventListener("DOMContentLoaded", (e) => {

  let content = document.querySelector(".content")
  let reportsActionsVariable = document.querySelector(".reports-footer__action__sort")
  let sortBlock = document.querySelector(".sort__block")
  let reportsFooter = document.querySelector(".reports-footer")

  content.addEventListener("click", e => {
    if(!reportsFooter.classList[1] || !sortBlock.classList[1]) {
      sortBlock.classList.add("none")
      reportsActionsVariable.classList.add("none")
    }
  })
})

