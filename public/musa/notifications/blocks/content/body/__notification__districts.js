$(document).ready(function () {

    var districtsBody = $(".notifications__districts__body__element")

    $(districts).each(function (i, item) {

        var district = districtsBody.clone(true)

        district.find(".notifications__districts__body__district-name").text(item.name)
        district.find(".notifications__districts__body__district-count").text(item.notificationCount + " уведомления")

        $(".notifications__districts__body").append(district)

    })

    $(".notifications__districts__body__element").eq(0).css("display", "none")

})