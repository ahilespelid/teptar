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


  // document.addEventListener("DOMContentLoaded", (e) => {
  //   var reportsBlock = document.querySelector(".reports")
  //   var reportsBody = document.querySelector(".reports__body")
  //   var reportsFooter = document.querySelector(".reports-footer")
  //   var reportsActions = document.querySelector(".reports-footer__action")
  //   var sortToggle = document.querySelector(".sort__toggle")
  //   var sortBlock = document.querySelector(".sort__block")
  //   var sortBlockElement = document.querySelectorAll(".sort__block__element")
  //   var reportsFooterCount = document.querySelector(".reports-footer__count")
  //

//   var checkbox = document.querySelectorAll(".reports__body__checkbox")
//
//   var firstCheckbox = document.querySelector(".reports-list__title__checkbox")
//
//   var checkboxArray = Array.from(checkbox)
//
//   firstCheckbox.addEventListener("click", (e) => {
//       if(firstCheckbox.checked) {
//         checkboxArray.map(item => {
//           item.checked = true
//           reportsFooter.classList.remove("none")
//           item.parentNode.parentNode.classList.add("checked")
//           reportsBlock.classList.add("reports__decrease-height")
//         })
//       } else {
//         checkboxArray.map(item => {
//           item.checked = false
//           reportsFooter.classList.add("none")
//           item.parentNode.parentNode.classList.remove("checked")
//           reportsBlock.classList.remove("reports__decrease-height")
//         })
//       }
//     }
//   )
//
//   sortToggle.addEventListener("click", e => {
//     e.stopPropagation()
//     sortBlock.classList.toggle("none")
//   })
//
//   var reportsElements = document.querySelectorAll(".reports__body__line")
//
//   var variables = Array.from(sortBlockElement)
//   var reportElements = Array.from(reportsElements)
//
//   checkboxArray.map(item => {
//     item.addEventListener("click", (e) => {
//       if(checkboxArray.every(item => item.checked === true)) {
//         firstCheckbox.checked = true
//       } else {
//         firstCheckbox.checked = false
//         reportsBlock.classList.remove("reports__decrease-height")
//       }
//       if(checkboxArray.some(item => item.checked === true)) {
//         reportsBlock.classList.add("reports__decrease-height")
//         reportsFooter.classList.remove("none")
//       } else {
//         reportsBlock.classList.remove("reports__decrease-height")
//         reportsFooter.classList.add("none")
//       }
//       reportElements.map(item => {
//         if(item.children[0].children[0].checked) {
//           item.classList.add("checked")
//         } else {
//           item.classList.remove("checked")
//         }
//       })
//     })
//   })
//
//   reportsFooterCount.textContent = `Отмечено 2/${reports.length}`
//
//   reportsActions.addEventListener("click", (e) => {
//     e.stopPropagation()
//     reportsActions.children[0].classList.toggle("none")
//   })
//
//   function fixDate (date) {
//     if(date === "May") {
//       return "май"
//     } else if(date === "Jun"){
//       return "июнь"
//     } else if(date === "Jul"){
//       return "июль"
//     } else if(date === "Aug"){
//       return "август"
//     } else if(date === "Sep"){
//       return "сентябрь"
//     } else if(date === "Oct"){
//       return "октябрь"
//     } else if(date === "Nov"){
//       return "ноябрь"
//     } else if(date === "Dec"){
//       return "декабрь"
//     } else if(date === "Jan"){
//       return "январь"
//     } else if(date === "Feb"){
//       return "февраль"
//     } else if(date === "Mar"){
//       return "март"
//     } else if(date === "Apr"){
//       return "апрель"
//     }
//   }
// })
