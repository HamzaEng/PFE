let btnMenu = document.getElementById("menu");
let button = document.getElementById("btn");
let menu = document.getElementById("nav");
let button1 = document.getElementById("btn1");
let button2 = document.getElementById("btn2");
let main = document.getElementById("main");


let btnState = 0;

btnMenu.addEventListener("click", ()=>{
    if(btnState == 0){        
        button.style.backgroundColor = "transparent";
        button1.style.transform = "rotate(45deg)";
        button2.style.transform = "rotate(-45deg)";
        menu.style.transform = "translateX(0)";
        document.body.style.overflow =  "hidden";
        btnState = 1;
    }
    else{
        animate();
    }
});

main.addEventListener("click", ()=>{
    if(btnState == 1){
        animate();
    }
});

function animate(){
    button.style.backgroundColor = "black";
    button1.style.transform = "rotate(0) translateY(-8px)";
    button2.style.transform = "rotate(0) translateY(7px)";
    menu.style.transform = "translateX(-1000px)";
    document.body.style.overflow = "scroll";
    btnState = 0;
}









