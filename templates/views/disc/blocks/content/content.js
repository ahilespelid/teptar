$(document).ready(function() {
  $(".content").on("click", function(e) {
    $(".sort__block").addClass("none")
    $(".reports-footer__action__sort").addClass("none")
    $(".user__dropdown-menu").addClass("none")
  })

  function checkExtension(array) {
    $(array).each(function (i, item) {
      var extension = item.name.split(".").slice(-1).join("")
      return extension
    })
  }

  [$(".submit_added_folder"), $(".submit_added_files")].forEach(function (item, index) {
    $(item).on("click", function (e) {
      $("#add_file").css({"opacity": 0, "pointer-events": "none"})
      $("#add_folder").css({"opacity": 0, "pointer-events": "none"})
      $(".black_background").css({'opacity':'0', 'pointer-events': 'none', 'z-index' : '0'})
    })
  })

  $(".add_file").on("click", function (e) {
    $("#add_file").css({"opacity": 1, "pointer-events": "auto"});
    $(".black_background").css({'opacity':'0.3', 'pointer-events': 'auto', 'z-index' : '10'})
  })

  $(".create_folder").on("click", function (e) {
    $("#add_folder").css({"opacity": 1, "pointer-events": "auto"});
    $(".black_background").css({'opacity':'0.3', 'pointer-events': 'auto', 'z-index' : '10'})
  })

  $(".black_background").on("click", function (e) {
    $("#add_file").css({"opacity": 0, "pointer-events": "none"})
    $("#add_folder").css({"opacity": 0, "pointer-events": "none"})
    $(".black_background").css({'opacity':'0', 'pointer-events': 'none', 'z-index' : '0'})
  })

  $(".fileload-modal__header images").on("click", function (e) {
    $("#add_file").css({"opacity": 0, "pointer-events": "none"})
    $("#add_folder").css({"opacity": 0, "pointer-events": "none"})
    $(".black" +
        "_background").css({'opacity':'0', 'pointer-events': 'none', 'z-index' : '0'})
  })

  var files = []

  $("#fileload-modal__input").on("change", function (e) {
    files.push($("#fileload-modal__input").prop("files"))[0]
    files.map(function (item) {
      console.log(item[0].name.split(".").slice(-1))
      if(file_add_modal.php) {}
      $(".fileload-modal__footer__files").append(
      )
    })
  })


})
