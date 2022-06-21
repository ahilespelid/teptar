$(document).ready(function () {

    var count = 0

    $(".disc-count").text($(".disc__element__header__checkbox").length)

    $(".disc__element__header__checkbox").each(function (i, item) {
        item.addEventListener("click", function (e) {

            console.log(count)

            if(e.target.checked) {
                count++
            } else {
                count--
            }
            $(".disc-checked").text(count)
        })
    })

})