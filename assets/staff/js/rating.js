var mapLinks = document.querySelectorAll('.map-link');

mapLinks.forEach(function (link) {
    link.addEventListener('mouseenter', function () {
        document.querySelector('.' + link.id.replace('MapLink', '')).style.fill = '#61B252';
    })
    link.addEventListener('mouseleave', function () {
        document.querySelector('.' + link.id.replace('MapLink', '')).removeAttribute('style');
    })
});

var mapAreas = document.querySelectorAll('.chechnya-map .area');

mapAreas.forEach(function (area) {
    area.addEventListener('mouseenter', function () {
        document.getElementById('MapLink' + area.classList[1]).style.border = '1px solid #61b252';
        document.getElementById('MapLink' + area.classList[1]).style.color = '#61b252';
        area.style.fill = '#61B252';
        area.style.cursor = 'pointer';
    })
    area.addEventListener('mouseleave', function () {
        document.getElementById('MapLink' + area.classList[1]).removeAttribute('style');
        area.removeAttribute('style');
    })
    area.addEventListener('click', function () {
        document.getElementById('MapLink' + area.classList[1]).click()
    })
})
