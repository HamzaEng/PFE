let techno = document.getElementById("Techniques")
let select = document.getElementById('matieres')
let second = document.getElementById('Secondaire')
techno.style.display ="none"
function displayTechno(){
    second.style.display = "none"
    techno.style.display ="block"
}
function displaySecond(){
    techno.style.display = "none"
    second.style.display ="block"
}


select.addEventListener('change', () =>{
    switch(select.value) {
        case 'Techniques' : displayTechno()
                            break
        default : displaySecond()
                  break
    }
})