$(document).ready(function(){

  /*/


    взять дату с сервера
    var date = String(new Date());

/*/


 /*/ Перебераем массив с отчетами /*/

  var raportLine = $('.reports__body__line').css('display','table-row');



  $(reports).each(function(i, item){

      var condition = item.term == "В работе" ? "warning" : item.term == "Дорабатывается" ? "expired" : item.term == "Успешно" && "checked"

      var raport = raportLine.clone(true);

      raport.find('.reports__body__line__name span').text(item.name);
      raport.find('.reports__body__line__activity').text(item.activity);
      raport.find('.reports__body__line__term span').addClass(condition).text(item.term);
      raport.find('.reports__body__avatar').attr("src", item.responsible.avatar);
      if(Array.isArray(item.assistant)) {
        raport.find('.reports__body__second__avatar ').attr("src", item.assistant[0].avatar);
        raport.find('.name-block').addClass("reports-list__more");
        raport.find(".reports__body__number").append("+1")
      } else {
        raport.find('.reports__body__second__avatar ').attr("src", item.assistant.avatar);
      }
      //console.log(raport);

      $('.reports__body').append(raport);
    });

  $(".reports__body__line").eq(0).css('display', 'none')

  // $(".reports__body__line").each(function (i, item){
  //     item.children[0].childNodes[1].addEventListener("click", function () {
  //         if($.makeArray($(".reports__body__checkbox")).some(function(item){ return item.checked === true})) {
  //               $(".reports").addClass("reports__decrease-height")
  //               $(".reports-footer").removeClass("none")
  //         } else {
  //               $(".reports").removeClass("reports__decrease-height")
  //               $(".reports-footer").addClass("none")
  //         }
  //         if(item.children[0].childNodes[1].checked) {
  //           item.className.add("checked")
  //         } else if(!item.children[0].childNodes[1].checked){
  //           $(this).children[0].childNodes[1].removeClass("checked")
  //         }
  //     })
  // })

  // $(".reports-list__title__checkbox").on("click", function (e) {

  //   if(e.target.checked) {
  //       $(".reports__body__line").each(function(i, item) {
  //         item.children[0].childNodes[1].checked = true
  //         $(this).addClass("checked")
  //         $(".reports").addClass("reports__decrease-height")
  //         $(".reports-footer").removeClass("none")
  //       })
  //     } else {
  //         $(".reports__body__line").each(function (i, item) {
  //             item.children[0].childNodes[1].checked = false
  //             $(this).removeClass("checked")
  //             $(".reports").removeClass("reports__decrease-height")
  //             $(".reports-footer").addClass("none")
  //         })
  //     }
  // })

  // $(".sort").on("click", function(e) {
  //   e.stopPropagation()
  //   $(".sort__block").toggleClass("none")
  // })

  // $(".reports-footer__action").on("click", function(e) {
  //   e.stopPropagation()
  //   $(".reports-footer__action__sort").toggleClass("none")
  // })

})

function fixDate (date) {
  if(date === "May") {
    return "мая"
  } else if(date === "Jun"){
    return "июня"
  } else if(date === "Jul"){
    return "июля"
  } else if(date === "Aug"){
    return "августа"
  } else if(date === "Sep"){
    return "сентября"
  } else if(date === "Oct"){
    return "октября"
  } else if(date === "Nov"){
    return "ноября"
  } else if(date === "Dec"){
    return "декабря"
  } else if(date === "Jan"){
    return "января"
  } else if(date === "Feb"){
    return "февраля"
  } else if(date === "Mar"){
    return "марта"
  } else if(date === "Apr"){
    return "апреля"
  }
}
