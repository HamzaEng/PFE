let usernam = document.getElementById('username');
let password = document.getElementById('password');
let login = document.getElementById('seConnect');
let state = 0;

  login.addEventListener('mouseover', btnEscape);
function btnEscape(){
    if(usernam.value === '' || password.value === ''){
        if(state == 0){
            login.style.transform = 'translateX(2%)';
            state = 1;
        }else{
            login.style.transform = 'translateX(-100%)';
            state = 0;
        }
    }
}



