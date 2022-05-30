document.addEventListener("DOMContentLoaded", (e) => {

  let reportsFooter = document.querySelector(".reports-footer")
  let reportsActionsVariable = document.querySelector(".reports-footer__action__sort")
  let sortBlock = document.querySelector(".sort__block")

  content.addEventListener("click", e => {
    if(!reportsFooter.classList[1] || !sortBlock.classList[1]) {
      sortBlock.classList.add("none")
      reportsActionsVariable.classList.add("none")
    }
  })

})
