let sentence = document.getElementById('sentence')
let observe = new IntersectionObserver(entries=>{
    entries.forEach(entrie=>{
        if(entrie.isIntersecting)
            entrie.target.classList.add("show")
        else {
            entrie.target.classList.remove("show")
        }
        
    })
})

let cards = document.querySelectorAll(".hidden")
cards.forEach(card=>observe.observe(card))

let pipeline = document.querySelector('.pipeline')
phrase = "liste des spécialités dans le Bts Essaouira"
index = 0;

id = setInterval(() =>{
    sentence.textContent += phrase[index]
    index++;
    if(index == phrase.length){
        clearInterval(id)
        pipeline.style.display = "none"
        
    }
},100);