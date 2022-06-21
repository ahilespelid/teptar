$(document).ready(function() {

  $(".sort").on("click", function(e) {
    e.stopPropagation()
    $(".sort__block").toggleClass("none")
  })

})