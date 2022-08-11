// $(document).ready(function () {
//
//     var count = 0
//
//     $(".disc-count").text($(".disc__element__header__checkbox").length)
//
//     $(".disc__element__header__checkbox").each(function (i, item) {
//         item.addEventListener("click", function (e) {
//             console.log(count)
//
//             if(e.target.checked) {
//                 count++
//             } else {
//                 count--
//             }
//             $(".disc-checked").text(count)
//
//         })
//     })
//
// })
//
// $(document).ready(function () {
//     let discCheckbox = $(".disc .disc__element__header__checkbox")
//
//     let checkedDiscElements = []
//
//     $(".disc__element__header__checkbox").each(function (i, item) {
//
//         $(item).on("click", function (e) {
//             e.stopPropagation()
//             $(e.target.parentNode.parentNode).toggleClass("warning")
//
//             if($.makeArray($(".disc__element__header__checkbox")).some(function (item) {return item.checked === true})) {
//                 $(".disc-footer").removeClass("none")
//                 $(".disc").addClass("disc__decrease-height")
//                 $(".disc__element__header__checkbox").each(function (i, item) {
//                     $(item).css({"opacity": "1", "pointer-events": "auto"})
//                 })
//             } else {
//                 $(".disc-footer").addClass("none")
//                 $(".disc").removeClass("disc__decrease-height")
//                 $(".disc__element__header__checkbox").each(function (i, item) {
//                     $(item).css({"opacity": "0", "pointer-events": "none"})
//                 })
//             }
//
//             $(".disc .disc__element__header__checkbox").each(function (item, index) {
//                 if($(item).prop("checked") === true) {
//                     checkedDiscElements.push(item)
//                 }
//             })
//
//             console.log(checkedDiscElements)
//
//         })
//
//     })
//
//     $(".icon-menu").on("click", function (e) {
//         e.stopPropagation()
//         $(this).next().toggleClass("none")
//     })
//
//     $(".dropdown__menu__element").on("click", function (e) {
//
//         e.stopPropagation()
//         $(this).parent().addClass("none")
//
//     })
//
//     var count = 0
//
//     $(".disc__element").on("click", function (e) {
//
//         $(this).children(".disc__element__header").children("input").trigger("click")
//
//         console.log($(this).children(".disc__element__header").children("input").is(":checked"))
//
//         if($(this).children(".disc__element__header").children("input").is(":checked")) {
//             console.log("okay")
//             count++
//         } else {
//             count--
//         }
//
//         $(".disc-checked").text(count)
//     })
//
//     $(".sort").on("click", function(e) {
//         e.stopPropagation()
//         $(".sort__block").toggleClass("none")
//     })
//
// })
//
// $(document).ready(function() {
//
//     let discCheckbox = $(".disc .disc__element__header__checkbox")
//
//     discCheckbox.prop("checked", false)
//
//     $(".content").on("click", function(e) {
//         $(".sort__block").addClass("none")
//         $(".reports-footer__action__sort").addClass("none")
//         $(".user__dropdown-menu").addClass("none")
//         $(".dropdown__menu").addClass("none")
//     })
//
//     function checkExtension(array) {
//         $(array).each(function (i, item) {
//             var extensionForFiles = item.name.split(".").slice(-1).join("")
//             return extensionForFiles
//         })
//     }
//
//     [$(".submit_added_folder"), $(".submit_added_files")].forEach(function (item, index) {
//         $(item).on("click", function (e) {
//             $("#add_file").css({"opacity": 0, "pointer-events": "none"})
//             $("#add_folder").css({"opacity": 0, "pointer-events": "none"})
//             $("#rename-modal").css({"opacity": 0, "pointer-events": "none"})
//             $("#rename-folder").val("")
//             $(".black_background").css({'opacity':'0', 'pointer-events': 'none', 'z-index' : '0'})
//         })
//     })
//
//     $(".add_file").on("click", function (e) {
//         $("#add_file").css({"opacity": 1, "pointer-events": "auto"});
//         $(".black_background").css({'opacity':'0.3', 'pointer-events': 'auto', 'z-index' : '1000'})
//     })
//
//     $(".create_folder").on("click", function (e) {
//         $("#add_folder").css({"opacity": 1, "pointer-events": "auto"});
//         $(".black_background").css({'opacity':'0.3', 'pointer-events': 'auto', 'z-index' : '1000'})
//     })
//
//     $(".black_background").on("click", function (e) {
//         $("#add_file").css({"opacity": 0, "pointer-events": "none"})
//         $("#add_folder").css({"opacity": 0, "pointer-events": "none"})
//         $("#rename-modal").css({"opacity": 0, "pointer-events": "none"})
//         $(".black_background").css({'opacity':'0', 'pointer-events': 'none', 'z-index' : '0'})
//     })
//
//     $(".fileload-modal__header img").on("click", function (e) {
//         $("#add_file").css({"opacity": 0, "pointer-events": "none"})
//         $("#add_folder").css({"opacity": 0, "pointer-events": "none"})
//         $("#rename-modal").css({"opacity": 0, "pointer-events": "none"})
//         $(".black_background").css({'opacity':'0', 'pointer-events': 'none', 'z-index' : '0'})
//     })
//
//     $(".dropdown__menu__element").on("click", function (e) {
//         if($(this).text().trim() === "Переименовать") {
//             $("#rename-modal").css({"opacity": 1, "pointer-events": "all"})
//             $(".black_background").css({"opacity": 0.3, "pointer-events": "all", "z-index": "1000"})
//         } else if($(this).text().trim() === "Удалить") {
//             $(this).parent().parent().parent().remove()
//         }
//
//     })
//
//     let files = [],
//
//     nf_button = document.getElementById("fileload-modal__input");
//
//     if (nf_button) {
//         nf_button.addEventListener("change", function (e) {
//             // files это FileList объект (похож на NodeList)
//             var f = nf_button.files;
//             // обходит файлы используя цикл
//             for (var i = 0; i < f.length; i++) {
//                 // Сохраняем элемент, если его не было
//                 files.push(f[i]);
//
//                 function containExtension(filename) {
//                     let extension = filename.toLowerCase().split('.').pop();
//                     let extensions = ['xlsx', 'jpg', 'mov', 'txt', 'word', 'zip', 'mp3', 'pdf', 'pptx'];
//
//                     return extensions.includes(extension);
//                 }
//
//                 console.log(files.length)
//
//                 if(files.length <= 4) {
//                     $(".fileload-modal__footer__files").append("<div class=\"fileload-modal__footer__files__element\">\n" +
//                         `                    <i class='icon-document'></i>\n` +
//                         `                    <span>${f[i].name.substring(0, 16)}</span>\n` +
//                         `                    <i class='icon-cross-circle files__element__delete'></i>` +
//                         "                </div>"
//                     )
//                 } else {
//                     $(".reports-title__my-reports__error").text("Ты слишком дэрзкий, больше четырех нельзя")
//                 }
//             }
//
//             $(".files__element__delete").on("click", function (e) {
//                 files.forEach(function (item, index) {
//                     if(item.name.substring(0, 16) === $(e.target).prev().text()) {
//                         files.splice(index, 1)
//                         $(e.target).parent().remove()
//                     }
//                 })
//             })
//
//         });
//     }
//
//     $(".fileload-modal__footer__submit button").on("click", function (e) {
//         $(".fileload-modal__footer__files__element").remove()
//         nf_button.value = ""
//         files = []
//     })
// })
