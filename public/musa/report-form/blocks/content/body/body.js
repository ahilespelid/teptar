$(document).ready(function() {

  $(".sort").on("click", function(e) {
    e.stopPropagation()
   $(".sort__block").toggleClass("none")
   $(".sort__block__month").addClass("none")
   $(".sort__block__year").addClass("none")
  })

  $(".sort-month").on("click", function(e) {
    e.stopPropagation()
    $(".sort__block__month").toggleClass("none")
    $(".sort__block").addClass("none")
    $(".sort__block__year").addClass("none")
  })

  $(".sort-year").on("click", function(e) {
    e.stopPropagation()
    $(".sort__block__year").toggleClass("none")
    $(".sort__block__month").addClass("none")
    $(".sort__block").addClass("none")
  })

})


// document.addEventListener("DOMContentLoaded", (e) => {
//   var sortToggle = document.querySelector(".sort")
//   var sortToggleMonth = document.querySelector(".sort-month")
//   var sortToggleYear = document.querySelector(".sort-year")
//   var sortBlock = document.querySelector(".sort__block")
//   var sortBlockMonth = document.querySelector(".sort__block__month")
//   var sortBlockYear = document.querySelector(".sort__block__year")

//   sortToggle.addEventListener("click", e => {
//     e.stopPropagation()
//     sortBlock.classList.toggle("none")
//     sortBlockMonth.classList.add("none")
//     sortBlockYear.classList.add("none")
//   })

//   sortToggleMonth.addEventListener("click", e => {
//     console.log(e)
//     e.stopPropagation()
//     sortBlockMonth.classList.toggle("none")
//     sortBlockYear.classList.add("none")
//     sortBlock.classList.add("none")
//   })

//   sortToggleYear.addEventListener("click", e => {
//     e.stopPropagation()
//     sortBlockYear.classList.toggle("none")
//     sortBlockMonth.classList.add("none")
//     sortBlock.classList.add("none")
//   })
// })
