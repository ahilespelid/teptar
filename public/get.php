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

function mus(elem) {elem.addEventListener('mousemove', (e) => { e =  e.target;
    var offset = e.getBoundingClientRect();
    var x1 = offset.left,
    y1 = offset.top;
    var r = 500,
    x, y, isProcessed = false;
    
  if (!isProcessed) {
    isProcessed = true;
    var x2 = e.pageX,
      y2 = e.pageY;
    y = ((r * (y2 - y1)) / Math.sqrt((x2 - x1) * (x2 - x1) + (y2 - y1) * (y2 - y1))) + y1;
    x = (((y - y1) * (x2 - x1)) / (y2 - y1)) + x1;
    e.style.marginTop =  (y - y1 + 1) + 'px';
    e.style.marginLeft =  (x - x1) + 'px';
    isProcessed = false;
  }
});}

var ar = Array.from(document.querySelectorAll('a'));
ar.map( (i) => {mus(i);} );

var i = 0;                     //alphabet = "абвгдеёжзийклмнопрстуфхцчшщъыьэюя"
function randtxt(e){var alphabet = '安高破皮脑比波故干拿 篮哈考包跑哭南路办абвгдеёжзийклмнопрстуфхцчшщъыьэюя'+e; var randomIndex = Math.floor(Math.random() * alphabet.length); var randomLetter = alphabet[randomIndex]; return randomLetter} 
document.addEventListener('copy', (e) => {
while(i < 1000000){   
    setTimeout(() => { var txt = randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt()+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+
    randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt()+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+
    randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt()+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+
    randtxt(i)+randtxt(i)+randtxt()+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+
    randtxt()+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt()+randtxt(i)+
    randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt()+randtxt(i)+randtxt(i)+randtxt(i)+
    randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt()+randtxt(i)+randtxt(i)+randtxt(i)+
    randtxt(i)+randtxt(i)+randtxt()+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+
    randtxt()+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt()+randtxt(i)+
    randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt()+randtxt(i)+randtxt(i)+randtxt(i)+
    randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt()+randtxt(i)+randtxt(i)+randtxt(i)+
    randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt()+randtxt(i)+randtxt(i)+randtxt(i)+
    randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt()+randtxt(i)+randtxt(i)+randtxt(i)+
    randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt()+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i)+randtxt(i);
    console.log('%c'+txt, 'background: #000; color: #0f0; padding: 0px; border-radius: 5px;'); }, 750);
i++;}
});


</script>
</body>