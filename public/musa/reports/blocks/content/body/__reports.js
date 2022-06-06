$(document).ready(function(){

  /*/


    взять дату с сервера
    var date = String(new Date());

/*/


 /*/ Перебераем массив с отчетами /*/

  var raportLine = $('.reports__body__line').css('display','table-row');



  $(reports).each(function(i, item){

      var raport = raportLine.clone(true);
      
      raport.find('.reports__body__line__name span').text(item.name);
      raport.find('.reports__body__line__activity').text(item.activity);
      raport.find('.reports__body__line__term').text(item.term);
      raport.find('.reports__body__line__assistant span').text(item.assistant.name)
      raport.find('.reports__body__line__assistant img').attr("src", item.assistant.avatar)
      raport.find('.reports__body__line__responsible span').text(item.responsible.name)
      raport.find('.reports__body__line__responsible img').attr("src", item.responsible.avatar)

      //console.log(raport);

      $('.reports__body').append(raport)
    });

  $(".reports__body__line").eq(0).css('display', 'none')

  $(".reports__body__line").eq(2).addClass("warning")

  $(".reports__body__line").eq(5).addClass("expired")

  $(".reports__body__line").each(function (i, item){
      item.children[0].childNodes[1].addEventListener("click", function () {
          if($.makeArray($(".reports__body__checkbox")).some(function(item){ return item.checked === true})) {
                $(".reports").addClass("reports__decrease-height")
                $(".reports-footer").removeClass("none")
          } else {
                $(".reports").removeClass("reports__decrease-height")
                $(".reports-footer").addClass("none")
          }
          if(item.children[0].childNodes[1].checked) {
            $(item).addClass("checked")
          } else if(!item.children[0].childNodes[1].checked){
            $(item).removeClass("checked")
          }
      })
  })

  $(".reports-list__title__checkbox").on("click", function (e) {

    if(e.target.checked) {
        $(".reports__body__line").each(function(i, item) {
          item.children[0].childNodes[1].checked = true
          $(this).addClass("checked")
          $(".reports").addClass("reports__decrease-height")
          $(".reports-footer").removeClass("none")
        })
      } else {
          $(".reports__body__line").each(function (i, item) {
              item.children[0].childNodes[1].checked = false
              $(this).removeClass("checked")
              $(".reports").removeClass("reports__decrease-height")
              $(".reports-footer").addClass("none")
          })
      }
  })

  $(".sort").on("click", function(e) {
    e.stopPropagation()
    $(".sort__block").toggleClass("none")
  })

  $(".reports-footer__action").on("click", function(e) {
    e.stopPropagation()
    $(".reports-footer__action__sort").toggleClass("none")
  })

})
