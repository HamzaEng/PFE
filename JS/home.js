let readMore = document.getElementById("readMore");
let more = document.getElementById("more");

readMore.addEventListener("click", ()=>{
    more.style.display = "block"
    more.style.lineHeight = "1.6";
    more.style.color = "#333";
    readMore.style.display = "none";
});