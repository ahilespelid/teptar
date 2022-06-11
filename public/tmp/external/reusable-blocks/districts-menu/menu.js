$(document).ready(function () {
  $(".menu__footer__toggle a")["0"].addEventListener("click", function () {
      $(".menu").toggleClass("menu__folded")
  })

    var path = document.location.search

    console.log(path)

    if(path.includes("notifications")) {
        $("#notifications").addClass("active")
    } else if(path.includes("disc")) {
        $("#disc").addClass("active")
    } else if(path.includes("district")) {
        $("#districts").addClass("active")
    } else if(path.includes("report")) {
        $("#my-reports").addClass("active")
    }
})
