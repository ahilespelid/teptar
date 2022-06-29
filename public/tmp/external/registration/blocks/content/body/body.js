$(document).ready(function (e) {

    $(".sort-year").on("click", function(e) {
        e.stopPropagation()
        $(".sort__block__year").toggleClass("none")
    })

    $("#male").on("click", function (e) {

        $(".sort__toggle__year__text").text("Мужской")

    })

    $("#female").on("click", function (e) {

        $(".sort__toggle__year__text").text("Женский")

    })

})