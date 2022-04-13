let activeCard = 0;
let array = [];
let cards;
let timer;


diaporama()


/**
 * Animate the diaporama and its buttons
 */

function diaporama(){
    let display = document.querySelector('#diaporama')
    cards = document.querySelectorAll('.diaporama-card')
    let prevBtn = document.querySelector('#previous-btn')
    let nextBtn = document.querySelector('#next-btn')
    for (let c of cards){
        array.push(c);
    }
    setTimer()

    prevBtn.addEventListener('click', function(){
        displayPrevCard()
        setActive()
    })

    nextBtn.addEventListener('click', function(){
        displayNextCard()
        setActive()
    })

    display.addEventListener('mouseover', function(){
        clearInterval(timer)
    })

    prevBtn.addEventListener('mouseover',function() {
        clearInterval(timer)
    })

    nextBtn.addEventListener('mouseover',function() {
        clearInterval(timer)
    })

    display.addEventListener('mouseout', function (){
        setTimer()
    })
    prevBtn.addEventListener('mouseout',function() {
        setTimer()
    })

    nextBtn.addEventListener('mouseout',function() {
        setTimer()
    })

}


/**
 * Change slide every 5s
 */

function setTimer(){
    timer = setInterval(function(){
        displayNextCard()
        setActive()
    }, 5000)
}

/**
 * Hide all slides except the active one
 */

function setActive(){
    for (let c of cards){
        c.classList.add('hidden')
    }
    cards[activeCard].classList.remove('hidden')
}

/**
 * Display the previous movie
 */

function displayPrevCard(){
    console.log(activeCard)
    activeCard--;
    if (activeCard < 0){
        activeCard = array.length-1;
    }
}

/**
 * Display the next movie
 */

function displayNextCard(){
    activeCard++;
    if (activeCard >= array.length){
        activeCard = 0;
    }
}