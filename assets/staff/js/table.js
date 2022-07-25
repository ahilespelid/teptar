$(document).ready(function (e) {

    $(".dropdown__menu").on("click", function (e) {
        e.stopPropagation()
        $(this).next().toggleClass("none")
    })

    $(".ministry input").on("keydown", function (e) {

        $(".table__footer").removeClass("none")
        $(".table").addClass("decrease__height")

    })

    $(".table__footer__button").on("click", function (e) {
        $(".table__footer").addClass("none")
        $(".table").removeClass("decrease__height")
    })

    $(".dropdown__menu__variables").last().css("top", "-60px")

    var variables = [".on-agreed", ".agreed"]

    variables.forEach(function (item, index) {

        $(item).on("click", function (e) {

            var text = $(this).text()
            $(this).parent().prev().children(".text").text(text)
            $(this).parents("tr").children(".status").text(text)
            $(".table__footer").removeClass("none")
            $(".table").addClass("decrease__height")

        })

    })

})
