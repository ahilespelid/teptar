$(document).ready(function (e) {
    $("#accept_report").on('click', function (e) {
        $(".success__modal").toggleClass("none")
    })

    $("#finalize_report").on('click', function (e) {
        $(".fail__modal").toggleClass("none")
    })

    $("#send_report_again").on("click", function (e) {

        $(".revision__modal").toggleClass("none")

    })

    $(".revision__modal__footer__approval__text").on('click', function (e) {
        $(".revision__modal__footer__approval input").trigger("click")
    })
})

$(document).ready(function() {
    $(".reports-body__content__header__download").on("click", function(e) {
        e.stopPropagation()
        $(".reports-footer__action__sort").toggleClass("none")
    })
})

$(document).ready(function() {

    $(".content").on("click", function(e) {

        $(".reports-footer__action__sort").addClass("none")
        $(".user__dropdown-menu").addClass("none")
    })

    let successModal = [".success__modal__header__exit", ".success__modal__body__button"]

    successModal.forEach(function (item, index) {
        $(item).on("click", function (e) {
            $(".success__modal").addClass("none")
        })
    })

    let failModal = [".fail_modal__body__button", ".fail__modal__header__exit"]

    failModal.forEach(function (item, index) {
        $(item).on("click", function (e) {
            $(".fail__modal").addClass("none")
        })
    })

    let revisionModal = ["#modal_send_report_again", ".revision__modal__header__exit"]

    revisionModal.forEach(function (item, index) {

        $(item).on("click", function (e) {
            $(".revision__modal").addClass("none")
        })

    })

    $(".revision__modal__footer__approval input").on("click", function (e) {

        $("#modal_send_report_again").css("background-color", "#00B894")

        if($(this).is(":checked")) {
            $("#modal_send_report_again").prop("disabled", false)
        } else {
            $("#modal_send_report_again").prop("disabled", true)
        }
    })

    $("#1").on("click", function (e) {
        $("#5").css("color", "unset")
        $("#2").css("color", "unset")
        $("#3").css("color", "unset")
        $("#4").css("color", "unset")
        $(this).css("color", "orange")
    })
    $("#2").on("click", function (e) {
        $("#1").css("color", "orange")
        $("#5").css("color", "unset")
        $("#3").css("color", "unset")
        $("#4").css("color", "unset")
        $(this).css("color", "orange")
    })
    $("#3").on("click", function (e) {
        $("#1").css("color", "orange")
        $("#2").css("color", "orange")
        $("#5").css("color", "unset")
        $("#4").css("color", "unset")
        $(this).css("color", "orange")
    })
    $("#4").on("click", function (e) {
        $("#1").css("color", "orange")
        $("#2").css("color", "orange")
        $("#3").css("color", "orange")
        $("#5").css("color", "unset")
        $(this).css("color", "orange")
    })
    $("#5").on("click", function (e) {
        $("#1").css("color", "orange")
        $("#2").css("color", "orange")
        $("#3").css("color", "orange")
        $("#4").css("color", "orange")
        $(this).css("color", "orange")
    })
})

$(document).ready(function (e) {
    var saveChangesButton = $(".save__changes button")

    let text = $('.reports-body__info').text().trim();

    $(".reports-body__header__edit").on("click", function (e) {
        if($(".reports-body__info").hasClass("textarea")) {
            $(".reports-body__info").replaceWith("<div autofocus class=\"reports-body__info\">\n" +
                `${text}`+"</div>")
            $(".reports-body__info").css("border", "none")
        } else {
            $(".reports-body__info").replaceWith("<textarea autofocus class=\"reports-body__info textarea\">\n" +
                `${text}`+"</textarea>")
            $(".reports-body__info").css("border", "1px solid #535c69")
        }

        $(".reports-body__info").on("keydown", function (e) {
            text = $(this).val()
            saveChangesButton.removeAttr("disabled")

            if(saveChangesButton.prop("disabled")) {
                saveChangesButton.addClass("disabled")
            } else {
                saveChangesButton.removeClass("disabled")
            }

            $(".save__changes span").text("")
        })

        $(".save__changes").toggleClass("none")
    })

    saveChangesButton.on("click", function (e) {
        $(".save__changes .message").append('<i class="icon-refresh spin"></i>');
        text = $(".reports-body__info").val()

        const reportId = new URLSearchParams(window.location.search).get('id');
        const axios = require('axios').default;

        axios.post('/report/edit?report=' + reportId, {
            description: text
        })
        .then((response) => {
            $(this).prop("disabled", "disabled")
            $(this).addClass("disabled")
            $(".save__changes .icon-refresh").remove()
            let message = null;

            if (response.data === 1) {
                message = 'Сохранено';
            } else {
                message = '<span style="color: #e87979">Ошибка соединения</span>';
            }
            $(".save__changes .message").append(message)
        })
    })
})
