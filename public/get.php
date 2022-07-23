<?php 
setcookie('theme',((!empty($_GET['id'])) ? $_GET['id'] : 'w'));
if(!empty($_GET['t'])){header('Location: '.$_SERVER['REQUEST_URI']);}

?>
<style type="text/css">
.w{background: #fff;}
.d{background: #000;}
</style>
 <body>
 <a href="<?=$_SERVER['REQUEST_URI'];?>?id=d">Тёмная</a><br>
 <a class="themeToggleButton" href="#">Тёмная</a><br>
 <pre>
<?php print_r($_COOKIE);?>
</pre>

<script>
function getCookie(name) {let matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)")); return matches ? decodeURIComponent(matches[1]) : undefined;}

let theme = getCookie('theme');
if(undefined != theme){document.querySelector('body').classList.add(theme); }else{document.querySelector('body').classList.add('w');}
let themeToggleButtons = document.querySelector('.themeToggleButton');
if (themeToggleButtons) {themeToggleButtons.addEventListener('click', () => {
    let body = document.querySelector('body');
    if ( body.classList.contains('d')){
        if('w' != getCookie('theme')){document.cookie = "theme=d; max-age=-1;"; document.cookie = "theme=w; max-age=86400; path=/";}
        body.classList.remove('d');
        body.classList.add('w');
    } else {
        if('d' != getCookie('theme')){document.cookie = "theme=w; max-age=-1;"; document.cookie = "theme=d; max-age=86400; path=/";}
        body.classList.remove('w');
        body.classList.add('d');
    }
});}
</script>
</body>