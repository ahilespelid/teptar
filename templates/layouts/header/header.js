$(document).ready(function () {

    $(".user__info__arrow").on('click', function (e) {
        e.stopPropagation()
        $(".user__dropdown-menu").toggleClass("none")
    })

})