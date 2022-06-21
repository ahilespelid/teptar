$(document).ready(function () {

    var districtsBody = $(".notifications__districts__body__element")
    var noticesBody = $(".notifications__notices__element")
    var activeElement = null

    $(districts).each(function (i, item) {

        var district = districtsBody.clone(true);

        district.find(".notifications__districts__body__district-name").text(item.name)
        district.find(".notifications__districts__body__district-count").text(item.notificationCount + " уведомления")

        $(".notifications__districts__body").append(district)
        
    })

    $(".notifications__districts__body__element").each(function(i, item) {
        $(item).on("click", function(e) {
            $(".notifications__notices__element").css("display", "flex")

            if (document.querySelector('.notifications__districts__body__element.checked')) {
                document.querySelector('.notifications__districts__body__element.checked').classList.toggle('checked')
            }
            $(this).toggleClass("checked")

            activeElement = $(this).find(".notifications__districts__body__district-name").text()

            $(".notifications__notices").text("")

            for(var i = 0; i < districts.length; i++) {
                if(districts[i].name === activeElement) {
                    districts[i].notifications.map(function(item, index) {
                        var notices = noticesBody.clone(true)

                        notices.find(".notifications__notices__text__name").text(districts[i].name)
                        notices.find(".notifications__notices__text__status").text(item.status)
                        
                        $(".notifications__notices").append(notices)
                    })
                }
            }
        })
    })


    $(".notifications__districts__body__element").eq(0).css("display", "none")

    $(".notifications__notices__element")
})
