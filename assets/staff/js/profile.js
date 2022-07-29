$(document).ready(function (e) {
    $("#profile__input__avatar").on("mouseover", function (e) {
        $(".profile__avatar label").removeClass("invisible")
    })

    $("#profile__input__avatar").on("mouseout", function (e) {
        $(".profile__avatar label").addClass("invisible")
    })
})

// $(document).ready(function() {
//     $('.profile__form__footer__button').on("click", function (e) {
//         $('.profile__form__footer__text').removeClass("none")
//     })
//
//     $("#telephone_number").on("keydown", (e) => forInput(e, "+7"))
//
//     var array = ["#telegram", "#vk", "#instagram"]
//
//     array.forEach(function (item, index) {
//
//         $(item).on("keydown", (e) => forInput(e, "@"))
//
//     })
//
//     function forInput(e, value) {
//         if (!e.target.value.includes(value)){
//             e.target.value = value + e.target.value
//         }
//     }
// })
