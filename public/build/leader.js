(()=>{var e={599:()=>{document.querySelectorAll(".collapse").forEach((function(e){e.querySelector(".collapse-button").addEventListener("click",(function(){e.classList.toggle("active");var t=e.querySelector(".collapse-content");t.style.maxHeight?t.style.maxHeight=null:t.style.maxHeight=t.scrollHeight+"px"}))}))},700:()=>{document.querySelector(".dropdown")&&(document.querySelectorAll(".dropdown").forEach((function(e){e.querySelector(".current").addEventListener("click",(function(t){t.stopPropagation(),document.querySelector(".dropdown.show")&&document.querySelector(".dropdown.show")!==e&&document.querySelector(".dropdown.show").classList.toggle("show"),e.classList.toggle("show");var o=window.innerHeight-e.getBoundingClientRect().bottom;e.querySelector(".options").offsetHeight>o?(e.classList.add("above"),e.querySelector(".options").style.bottom="calc(-"+o+"px + 10px)"):e.classList.contains("above")&&e.classList.remove("above")})),e.classList.contains("interactive")&&e.querySelectorAll(".options .option").forEach((function(t){t.addEventListener("click",(function(o){o.stopPropagation(),e.querySelector(".title")?e.querySelector(".current").innerHTML='<span class="title">'+e.querySelector(".title").innerHTML+"</span> "+t.innerHTML:e.querySelector(".current").innerHTML=t.innerHTML,e.classList.toggle("show")}))}))})),window.onclick=function(e){document.querySelector(".dropdown.show")&&e.target.parentNode!==document.querySelector(".dropdown.show")&&document.querySelector(".dropdown.show").classList.toggle("show")})},971:()=>{document.querySelectorAll(".sortable-table th").forEach((function(e){e.addEventListener("click",(function(){!function(e,t,o=!0){const r=o?1:-1,n=e.tBodies[0],c=Array.from(n.querySelectorAll("tr")).sort((function(e,o){return e.querySelector(`td:nth-child(${t+1})`).textContent.trim()>o.querySelector(`td:nth-child(${t+1})`).textContent.trim()?1*r:-1*r}));for(;n.firstChild;)n.removeChild(n.firstChild);n.append(...c),e.querySelectorAll("th").forEach((function(e){e.classList.remove("th-sort-asc","th-sort-desc")})),e.querySelector(`th:nth-child(${t+1})`).classList.toggle("th-sort-asc",o),e.querySelector(`th:nth-child(${t+1})`).classList.toggle("th-sort-desc",!o)}(e.parentElement.parentElement.parentElement,Array.prototype.indexOf.call(e.parentElement.children,e),!e.classList.contains("th-sort-asc"))}))})),document.querySelectorAll('a[href^="#"]').forEach((function(e){e.addEventListener("click",(function(e){e.preventDefault(),document.querySelector(this.getAttribute("href")).scrollIntoView({behavior:"smooth"})}))})),document.querySelectorAll(".districts-score-table").forEach((function(e){e.querySelectorAll(".table-progress-bar").forEach((e=>{e.querySelector(".table-progress-bar-gradient").innerHTML=e.style.width,e.style.backgroundColor="hsl("+(e.style.width.replace("%","")/100*(120-0)+0)+", 60%, 56%)"})),e.querySelector("thead tr").insertAdjacentHTML("afterbegin",'<th class="separator"></th>'),e.querySelector("thead tr").insertAdjacentHTML("beforeend",'<th class="separator"></th>'),e.querySelectorAll("tbody tr").forEach((e=>{e.insertAdjacentHTML("afterbegin",'<td class="separator"></td>')})),e.querySelectorAll("tbody tr").forEach((e=>{e.insertAdjacentHTML("beforeend",'<td class="separator"></td>')}))})),document.querySelectorAll(".collapse-indicator").forEach((function(e){e.classList.contains("muted")||e.querySelector(".collapse-indicator-button").addEventListener("click",(function(){if(document.querySelector(".collapse-indicator.active")&&!e.classList.contains("active")){var t=document.querySelector(".collapse-indicator.active");t.classList.toggle("active"),t.querySelector(".collapse-indicator-content").style.maxHeight=null,document.querySelector(".collapse-indicator.previous-open")&&document.querySelector(".collapse-indicator.previous-open").classList.toggle("previous-open")}var o=e.nextElementSibling;e.classList.toggle("active");var r=e.querySelector(".collapse-indicator-content");r.style.maxHeight?(o&&o.classList.remove("previous-open"),r.style.maxHeight=null):(o&&o.classList.add("previous-open"),r.style.maxHeight=r.scrollHeight+"px")}))})),document.querySelectorAll(".map-link").forEach((function(e){e.addEventListener("mouseenter",(function(){document.querySelector("."+e.id.replace("MapLink","")).style.fill="#61B252"})),e.addEventListener("mouseleave",(function(){document.querySelector("."+e.id.replace("MapLink","")).removeAttribute("style")}))})),document.querySelectorAll(".chechnya-map .area").forEach((function(e){e.addEventListener("mouseenter",(function(){document.getElementById("MapLink"+e.classList[1]).style.border="1px solid #61b252",document.getElementById("MapLink"+e.classList[1]).style.color="#61b252",e.style.fill="#61B252",e.style.cursor="pointer"})),e.addEventListener("mouseleave",(function(){document.getElementById("MapLink"+e.classList[1]).removeAttribute("style"),e.removeAttribute("style")})),e.addEventListener("click",(function(){document.getElementById("MapLink"+e.classList[1]).click()}))}))}},t={};function o(r){var n=t[r];if(void 0!==n)return n.exports;var c=t[r]={exports:{}};return e[r](c,c.exports,o),c.exports}o.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return o.d(t,{a:t}),t},o.d=(e,t)=>{for(var r in t)o.o(t,r)&&!o.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},o.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{"use strict";o(971),o(599),o(700)})()})();