var collapseElements = document.querySelectorAll('.collapse');

collapseElements.forEach(function (block) {
    block.querySelector('.collapse-button').addEventListener('click', function () {

        block.classList.toggle("active");
        var content = block.querySelector('.collapse-content');

        if (content.style.maxHeight){
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    })
})
