$(document).ready(function (){
{///*/ Переменные обьявляем ///*/
var  disc = $(".disc"), discCheckbox = $(".disc .disc__element__header__checkbox"), discCount = $(".disc-count"), discChecked = $(".disc-checked"), discFooter = $(".disc-footer"),
        dropdownMenu = $(".dropdown__menu__element"),
        renameModal = $("#rename-modal"), blackBackground = $(".black_background"), iconCross = $(".icon-cross"),
        divAddFile = $("#add_file"), divAddFolder = $("#add_folder"), nf_button = document.getElementById("fileload-modal__input"),
        
        checkedDiscElements = [], count = 0, files = [], 
        
        cssO_0 = {"opacity": 0, "pointer-events": "none"}, cssO_1 = {"opacity": 1, "pointer-events": "auto"}, cssO13 = {"opacity": 0.3, "pointer-events": "auto", "z-index": 1000}, cssO03 = {"opacity": 0, "pointer-events": "none", "z-index": 0};
 
///*/ Выбрано элементов ///*/     
discCount.text(discCheckbox.length); discCheckbox.on("click", function(e){if(e.target.checked){count++;}else{count--;} discChecked.text(count);});

///*/ Активность всяких кнопок ///*/
$(".icon-menu").on("click", function (e){e.stopPropagation();  $(this).next().toggleClass("none");});
dropdownMenu.on("click", function (e){e.stopPropagation();  $(this).parent().addClass("none");});
discCheckbox.prop("checked", false);         

///*/ Выделение нажатием на сам элемент ///*/
$(".disc__element").on("click", function (e){e.stopPropagation(); $(this).children(".disc__element__header").children("input").trigger("click");});

///*/ Выделение файлов ///*/
 discCheckbox.each(function (i, item){$(item).on("click", function (e){e.stopPropagation(); $(e.target.parentNode.parentNode).toggleClass("warning");
    if($.makeArray(discCheckbox).some(function(item){return item.checked === true})){
        discFooter.removeClass("none"); 
        disc.addClass("disc__decrease-height"); 
        $(item).css(cssO_1);
    } else {
        discFooter.addClass("none"); 
        disc.removeClass("disc__decrease-height"); 
        discCheckbox.each(function (i, item){$(item).css(cssO_0)});
    }discCheckbox.each(function (item, index){if($(item).prop("checked") === true){checkedDiscElements.push(item);}});
 });});

 ///*/ Переименование и удаление из выпадающего списка ///*/
dropdownMenu.on("click", function (e){var val = $(this).text().trim(); 
    if("Переименовать" == val){
        renameModal.css(cssO_1); 
        blackBackground.css(cssO13);
    }else if("Удалить" == val){
        $(this).parent().parent().parent().remove(); 
        discCount.text(discCheckbox.length); discChecked.text(count = (count > 0) ? count-- : count);
}});
 
///*/ Удаление всех выделенных файлов ///*/
$("#del").on("click", function(e){discCheckbox.each(function(i, item){
    if($(item).prop("checked")){$(item).parent().parent().remove(); discCount.text(discCheckbox.length);}
});discChecked.text(count = 0); discFooter.addClass("none"); disc.removeClass("disc__decrease-height"); discCheckbox.each(function (i, item){$(item).css(cssO_0)});});

///*/   ///*/
[$(".submit_added_folder"), $(".submit_added_files")].forEach(function (item, index){$(item).on("click", function (e){
        divAddFile.css(cssO_0); 
        divAddFolder.css(cssO_0);
        renameModal.css(cssO_0);  
        blackBackground.css(cssO13); 
        $("#rename-folder").val("");
});});
///*/ Кнопка добавить файл ///*/
$(".sumbit_add_file").on("click", function (e){divAddFile.css(cssO_1); blackBackground.css(cssO13);});
///*/ Кнопка добавить папку ///*/
$(".sumbit_create_folder").on("click", function (e){divAddFolder.css(cssO_1); blackBackground.css(cssO13);});
///*/ Кнопка Х в модальных окнах и Фон модальных окон ///*/
[blackBackground, iconCross].forEach(function (item, i){$(item).on("click", function (e){divAddFile.css(cssO_0); divAddFolder.css(cssO_0); renameModal.css(cssO_0); blackBackground.css(cssO03);});});
///*/ Работа с файлами при клике на кнопку Добавить в модальном окне ///*/
if(nf_button){nf_button.addEventListener("change", function (e){var f = nf_button.files;
    for (var i = 0; i < f.length; i++){if(f.length <= 4 && files.length < 4){files.push(f[i]); console.log(files.length,f[i]);
        $(".fileload-modal__footer__files").append('<div class="fileload-modal__footer__files__element"><i class="icon-document"></i><span>'+(f[i].name.substring(0, 16))+'</span><i class="icon-cross-circle files__element__delete"></i></div>');
        } else {$(".reports-title__my-reports__error").text("Ты слишком дэрзкий, больше четырех нельзя");}
    }

    $(".files__element__delete").on("click", function (e){
        files.forEach(function (item, i){if(item.name.substring(0, 16) === $(e.target).prev().text()){
            console.log(files);
            files.splice(i, 1);
            console.log(files);
            $(e.target).parent().remove();
    }});});
});}
///*/ Отправка файлов ///*/
$(".fileload-modal__footer__submit button").on("click", function (e){
    console.log(files);
    divAddFile.css(cssO_0); blackBackground.css(cssO03);$(".fileload-modal__footer__files__element").remove(); nf_button.value = ""; files = [];});
}});
 // избыточно
/*/  $(".sort").on("click", function(e){e.stopPropagation(); $(".sort__block").toggleClass("none");}); $(".content").on("click", function(e){$(".sort__block").addClass("none"); $(".reports-footer__action__sort").addClass("none"); $(".user__dropdown-menu").addClass("none"); $(".dropdown__menu").addClass("none");}); 
function checkExtension(array){$(array).each(function (i, item){var extensionForFiles = item.name.split(".").slice(-1).join(""); return extensionForFiles;});} 
function containExtension(filename){let extension = filename.toLowerCase().split('.').pop(); let extensions = ['xlsx', 'jpg', 'mov', 'txt', 'word', 'zip', 'mp3', 'pdf', 'pptx']; return extensions.includes(extension);}
///*/
