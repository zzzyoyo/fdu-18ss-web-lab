var bigImg = document.getElementById("featured");
var imgs = document.getElementById("thumbnails").childNodes;
for(i=0;i<imgs.length;i++){
    imgs[i].addEventListener("click",replace,false);
}
var mouseover = false;
bigImg.addEventListener("mouseover",appear,false);
bigImg.addEventListener("mouseout",disappear,false);
function appear(){
    mouseover = true;
    var timer = null;
    var delayTime = 1000/ 60;
    var figcaption = document.getElementById("title");
    var newOpacity = Number(figcaption.style.opacity)+0.013;
    figcaption.style.opacity = newOpacity;
    timer = setTimeout(appear, delayTime);
    if(figcaption.style.opacity > 0.8 || !mouseover){
        clearInterval(timer);
    }
}
function disappear(){
    mouseover = false;
    var timer = null;
    var delayTime = 1000/ 60;
    var figcaption = document.getElementById("title");
    var newOpacity = Number(figcaption.style.opacity)-0.013;
    figcaption.style.opacity =newOpacity;
    timer = setTimeout(disappear, delayTime);
    if(figcaption.style.opacity <0 || mouseover){
        clearInterval(timer);
    }
}
function replace(event){
    event = event ? event : window.event;
    var obj = event.srcElement ? event.srcElement : event.target;
    var imgSrc = obj.src;
    var imgTittle = obj.title;
    document.getElementById("big").src = imgSrc.replace("small","medium");
    document.getElementById("big").title = imgTittle;
}