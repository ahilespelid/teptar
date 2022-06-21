$(document).ready(function () {
    $(".disc__element__header__checkbox").each(function (i, item) {

        $(item).on("click", function (e) {

            $(e.target.parentNode.parentNode).toggleClass("warning")

            if($.makeArray($(".disc__element__header__checkbox")).some(function (item) {return item.checked === true})) {
                $(".disc-footer").removeClass("none")
                $(".disc").addClass("disc__decrease-height")
                $(".disc__element__header__checkbox").each(function (i, item) {
                    $(item).css({"opacity": "1", "pointer-events": "auto"})
                })
            } else {
                $(".disc-footer").addClass("none")
                $(".disc").removeClass("disc__decrease-height")
                $(".disc__element__header__checkbox").each(function (i, item) {
                    $(item).css({"opacity": "0", "pointer-events": "none"})
                })
            }

        })

    })

    $(".sort").on("click", function(e) {
        e.stopPropagation()
        $(".sort__block").toggleClass("none")
    })
})