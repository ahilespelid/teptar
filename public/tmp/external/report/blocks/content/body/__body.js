$(document).ready(function() {

    $(".reports-body__content__header__download").on("click", function(e) {
        
        e.stopPropagation()

        $(".reports-footer__action__sort").toggleClass("none")

    })

})