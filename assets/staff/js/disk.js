$(document).ready(function (){   
{///*/ Переменные обьявляем ///*/
var  disc = $(".disc"), discCheckbox = $(".disc .disc__element__header__checkbox"), discCount = $(".disc-count"), discChecked = $(".disc-checked"), discFooter = $(".disc-footer"),
        dropdownMenu = $(".dropdown__menu__element"),
        renameModal = $("#rename-modal"), blackBackground = $(".black_background"), blackBackgroundWaiting = $(".black_background_delete"),iconCross = $(".icon-cross"),
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
dropdownMenu.on("click", function (e){
    var val = $(this).text().trim(), path = $(this).closest('.disc__element').attr('data-path'); 
    if("Переименовать" == val){
         var action = '621f0bb63e77';
        
        $('#rename_folder').on('input', function(){
             $.ajax({
                type: "POST",
                url: '/disk',
                cache: false,
                contentType: false,
                processData: false,
                data: {'42208e4e': path, '2788b398': action, '3288b546': $(this).val()},
                success: function(data){
                    console.log(data);
                    disc.pulse({times: 2, duration: 150});
            }});
        });       
        
        console.log(path);
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
    beforeSend: function(){blackBackgroundWaiting.css('pointer-events: none!important'); blackBackgroundWaiting.addClass(O_1);},
    success: function(data, status, xhr){ 
        blackBackgroundWaiting.removeClass(O_1); blackBackgroundWaiting.css('pointer-events: auto!important');
        disc.pulse({times: 2, duration: 150});
        var blob = new Blob([data], {type: xhr.getResponseHeader('Content-Type')}), link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        if(xhr.getResponseHeader('Content-Disposition')){filename = xhr.getResponseHeader('Content-Disposition').split('='); filename = (filename) ? decodeURIComponent(escape(filename[1])) : decodeURIComponent(escape(name));}
        link.download = filename; link.click();}});
});});


$('.ren').on('click', function(e){var name = $(this).attr('data-path'); console.log(name);});
 
///*/ Навигация по папкам ///*/ 
$('.disk').on("dblclick", function (e){
    var name = $(this).attr('data-path');
    $('body').load("/disk?07c5be14="+name);
}); 
 
///*/ Удаление всех выделенных файлов ///*/
$("#del").on("click", function(e){discCheckbox.each(function(i, item){if($(item).prop("checked")){var parent = $(item).parent().parent();
    console.log(parent.attr('data-path'));
    var action = 'c287b455c3d5';
    var name = parent.attr('data-path');
    var mime = parent.attr('data-mime');
    var filename = name;  
$.ajax({
    url: '/disk', type: 'POST', data:  {'05c7be12' : name, 'bb4de946' : action},
    dataType: 'binary',
    xhrFields: {'responseType': 'blob'},
    beforeSend: function(){blackBackgroundWaiting.css('pointer-events: none!important'); blackBackgroundWaiting.addClass(O_1);},
    success: function(data, status, xhr){ 
        blackBackgroundWaiting.removeClass(O_1); blackBackgroundWaiting.css('pointer-events: auto!important');
        var blob = new Blob([data], {type: xhr.getResponseHeader('Content-Type')}), link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        if(xhr.getResponseHeader('Content-Disposition')){filename = xhr.getResponseHeader('Content-Disposition').split('='); filename = (filename) ? decodeURIComponent(escape(filename[1])) : decodeURIComponent(escape(name));}
        link.download = filename; link.click(); parent.remove(); discCount.text(discCheckbox.length); }});  
disc.pulse({times: 2, duration: 150});}
});discChecked.text(count = 0); discFooter.addClass("none"); disc.removeClass("disc__decrease-height"); discCheckbox.each(function (i, item){$(item).removeClass(O_1);});});
///*/ Скачивание всех выделенных файлов ///*/
$("#get").on("click", function(e){discCheckbox.each(function(i, item){if($(item).prop("checked")){var parent = $(item).parent().parent();
    //console.log(parent.attr('data-path'));
    var action = 'c287b455c3d4';
    var name = parent.attr('data-path');
    var mime = parent.attr('data-mime');
    var filename = name;  
$.ajax({
    url: '/disk', type: 'POST', data:  {'05c7be12' : name, 'bb4de946' : action},
    dataType: 'binary',
    xhrFields: {'responseType': 'blob'},
    beforeSend: function(){blackBackgroundWaiting.css('pointer-events: none!important'); blackBackgroundWaiting.addClass(O_1);},
    success: function(data, status, xhr){ 
        blackBackgroundWaiting.removeClass(O_1); blackBackgroundWaiting.css('pointer-events: auto!important');
        var blob = new Blob([data], {type: xhr.getResponseHeader('Content-Type')}), link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        if(xhr.getResponseHeader('Content-Disposition')){filename = xhr.getResponseHeader('Content-Disposition').split('='); filename = (filename) ? decodeURIComponent(escape(filename[1])) : decodeURIComponent(escape(name));}
        link.download = filename; link.click(); discCount.text(discCheckbox.length); }});  
disc.pulse({times: 2, duration: 150});}
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
    for (var i = 0; i < f.length; i++){if(f.length <= 4 && files.length < 4){files.push(f[i]); 
        $(".fileload-modal__footer__files").append('<div class="fileload-modal__footer__files__element"><i class="icon-document"></i><span>'+(f[i].name.substring(0, 16))+'</span><i class="icon-cross-circle files__element__delete"></i></div>');
        } else {$(".reports-title__my-reports__error").text("Ты слишком дэрзкий, больше четырех нельзя");}
    }
    $(".files__element__delete").on("click", function (e){
        files.forEach(function (item, i){if(item.name.substring(0, 16) === $(e.target).prev().text()){
            console.log(files);
            files.splice(i, 1);
            $(e.target).parent().remove();
    }});});
});}
///*/ Отправка файлов ///*/
$(".fileload-modal__footer__submit button").on("click", function (e){e.preventDefault(); console.log(files);blackBackground.removeClass(O_1);  divAddFile.removeClass(O_1);
    if(undefined === window.FormData){console.log('В вашем браузере FormData не поддерживается');}else{
        var formData = new FormData(), rootPath = $('.disc').attr('data-root');
        $.each(nf_button.files, function(key, input){formData.append('29D7367d[]', input); console.log(input)});  
        formData.append('6f6Ad9D4', $('.disc').attr('data-root'));

        $.ajax({
            type: "POST",
            url: '/disk',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            beforeSend: function(data){//console.log('1',data); 
            blackBackgroundWaiting.css('pointer-events: none!important'); blackBackgroundWaiting.addClass(O_1);},
            success: function(data){ //console.log('2',data);
                blackBackgroundWaiting.removeClass(O_1); blackBackgroundWaiting.css('pointer-events: auto!important');
                disc.pulse({times: 2, duration: 150});
                $('body').load("/disk?07c5be14="+rootPath);
        }});} 
    $(".fileload-modal__footer__files__element").remove(); nf_button.value = ""; files = [];
return false;});  
}});