let parent = document.getElementById('fl');
let options = Array.from(parent.children);
let semestre = document.getElementById('semestre')


semestre.addEventListener('change', () =>{
    switch(semestre.value) {
        case 'EN' : secondYears()
                    break
        case 'EP' : firstYear()
                    break
        default : displayAll()
                  break
    }
})

function secondYears() {
    for (index = 0; index < 6; index++)
        if (index < 3){
            options[index].style.display = "none";
            parent.value = "SRI2";
        }
        else
            options[index].style.display = "block";
}

function firstYear() {
    for (index = 0; index < 6; index++)
        if (index >= 3){
            options[index].style.display = "none";
            parent.value = "SRI1";
        }
        else
            options[index].style.display = "block";
}

function displayAll() {
    for(index = 0; index < options.length; index++)
        options[index].style.display =  "block"
}