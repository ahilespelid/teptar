$(document).ready(function (){   
{///*/ Переменные обьявляем ///*/
var  disc = $(".disc"), discCheckbox = $(".disc .disc__element__header__checkbox"), discCount = $(".disc-count"), discChecked = $(".disc-checked"), discFooter = $(".disc-footer"),
        dropdownMenu = $(".dropdown__menu__element"),
        renameModal = $("#rename-modal"), blackBackground = $(".black_background"), iconCross = $(".icon-cross"),
        divAddFile = $("#add_file"), divAddFolder = $("#add_folder"), nf_button = document.getElementById("fileload-modal__input"),
        checkedDiscElements = [], count = 0, files = [], O_1 = "onModal";
 
///*/ Выбрано элементов ///*/     
discCount.text(discCheckbox.length); discCheckbox.on("click", function(e){if(e.target.checked){count++;}else{count--;} discChecked.text(count);});

///*/ Активность всяких кнопок ///*/
$(".icon-menu").on("click", function (e){e.stopPropagation();  $(this).next().toggleClass("none");});
dropdownMenu.on("click", function (e){e.stopPropagation();  $(this).parent().addClass("none");});
discCheckbox.prop("checked", false);         

///*/ Выделение нажатием на сам элемент ///*/
$(".disc__element").on("click", function (e){e.stopPropagation(); $(this).children(".disc__element__header").children("input").trigger("click");});

///*/ Выделение файлов ///*/
 discCheckbox.each(function (i, item){
    $(item).on("click", function (e){e.stopPropagation(); $(e.target.parentNode.parentNode).toggleClass("warning");
    if($.makeArray(discCheckbox).some(function(item){return item.checked === true})){
        discFooter.removeClass("none"); 
        disc.addClass("disc__decrease-height"); 
        discCheckbox.each(function (i, item){$(item).css({"opacity": "1"});});
    } else {
        discFooter.addClass("none"); 
        disc.removeClass("disc__decrease-height"); 
        discCheckbox.each(function (i, item){$(item).css({"opacity": "0"});});
    }discCheckbox.each(function (item, index){if($(item).prop("checked") === true){checkedDiscElements.push(item);}});
 });});

 ///*/ Переименование и удаление скачивание из выпадающего списка ///*/
dropdownMenu.on("click", function (e){var val = $(this).text().trim(); 
    if("Переименовать" == val){
        renameModal.addClass(O_1);
        blackBackground.addClass(O_1); 
    }else if("Удалить" == val){
        $(this).parent().parent().parent().remove(); 
        discCount.text(discCheckbox.length); discChecked.text(count = (count > 0) ? count-- : count);
}});
[$('.get'), $('.del')].forEach(function (item, i){$(item).on("click", function (e){
    var action = ($(this).hasClass('get')) ? '4e9958b1f1b5' : 'c287b455c3d5';
    var name = $(this).closest('div.disc__element').attr('data-path');
    var mime = $(this).closest('div.disc__element').attr('data-mime');
    var filename = name;  
$.ajax({
    url: '/disk', type: 'POST', data:  {'05c7be12' : name, 'bb4de946' : action},
    dataType: 'binary',
    xhrFields: {'responseType': 'blob'},
    beforeSend: function(){blackBackground.css('pointer-events: none!important'); blackBackground.addClass(O_1);},
    success: function(data, status, xhr){ 
        blackBackground.removeClass(O_1); blackBackground.css('pointer-events: auto!important');
        disc.pulse({times: 2, duration: 150});
        var blob = new Blob([data], {type: xhr.getResponseHeader('Content-Type')}), link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        if(xhr.getResponseHeader('Content-Disposition')){filename = xhr.getResponseHeader('Content-Disposition').split('='); filename = (filename) ? decodeURIComponent(escape(filename[1])) : decodeURIComponent(escape(name));}
        link.download = filename; link.click();}});
});});


$('.ren').on('click', function(e){var name = $(this).attr('data-path');
$.ajax({
    url: '/disk', type: 'POST', data:  {'renFile': $(this).attr('data-path')},
    success: function (data, textStatus, jqXHR){
        if(jqXHR.getResponseHeader('Content-Disposition')){filename = jqXHR.getResponseHeader('Content-Disposition').split('='); filename = (filename) ? decodeURIComponent(escape(filename[1])) : decodeURIComponent(escape(name));}
        $(this).pulse({times: 2, duration: 150});
        console.log(data);

}});});
 
///*/ Навигация по папкам ///*/ 
$('.disk').on("dblclick", function (e){
    var name = $(this).attr('data-path');
$.ajax({
    url: '/disk', type: 'POST', data:  {'07c5be14' : name},
    success: function(data, status, xhr) {
        var blob = new Blob([data], {type: xhr.getResponseHeader('Content-Type')}), link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        if(xhr.getResponseHeader('Content-Disposition')){filename = xhr.getResponseHeader('Content-Disposition').split('='); filename = (filename) ? decodeURIComponent(escape(filename[1])) : decodeURIComponent(escape(name));}
        link.download = filename; link.click();}});
}); 
 
///*/ Удаление всех выделенных файлов ///*/
$("#del").on("click", function(e){discCheckbox.each(function(i, item){
    if($(item).prop("checked")){$(item).parent().parent().remove(); discCount.text(discCheckbox.length);}
});discChecked.text(count = 0); discFooter.addClass("none"); disc.removeClass("disc__decrease-height"); discCheckbox.each(function (i, item){$(item).removeClass(O_1);});});

///*/   ///*/
[$(".submit_added_folder"), $(".submit_added_files")].forEach(function (item, index){$(item).on("click", function (e){
        divAddFile.removeClass(O_1); divAddFolder.removeClass(O_1); renameModal.removeClass(O_1); blackBackground.removeClass(O_1); 
        $("#rename-folder").val("");
});});
///*/ Кнопка добавить файл ///*/
$(".sumbit_add_file").on("click", function (e){divAddFile.addClass(O_1); blackBackground.addClass(O_1);});
///*/ Кнопка добавить папку ///*/
$(".sumbit_create_folder").on("click", function (e){divAddFolder.addClass(O_1); blackBackground.addClass(O_1);});
///*/ Кнопка Х в модальных окнах и Фон модальных окон ///*/
[blackBackground, iconCross].forEach(function (item, i){$(item).on("click", function (e){divAddFile.removeClass(O_1); divAddFolder.removeClass(O_1); renameModal.removeClass(O_1); blackBackground.removeClass(O_1);});});
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
$(".fileload-modal__footer__submit button").on("click", function (e){blackBackground.removeClass(O_1);  divAddFile.removeClass(O_1);
    console.log(files);
    
    $(".fileload-modal__footer__files__element").remove(); nf_button.value = ""; files = [];});
}});
 // избыточно
/*/  $(".sort").on("click", function(e){e.stopPropagation(); $(".sort__block").toggleClass("none");}); $(".content").on("click", function(e){$(".sort__block").addClass("none"); $(".reports-footer__action__sort").addClass("none"); $(".user__dropdown-menu").addClass("none"); $(".dropdown__menu").addClass("none");}); 
function checkExtension(array){$(array).each(function (i, item){var extensionForFiles = item.name.split(".").slice(-1).join(""); return extensionForFiles;});} 
function containExtension(filename){let extension = filename.toLowerCase().split('.').pop(); let extensions = ['xlsx', 'jpg', 'mov', 'txt', 'word', 'zip', 'mp3', 'pdf', 'pptx']; return extensions.includes(extension);}
///*/
