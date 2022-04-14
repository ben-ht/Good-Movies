let synopsisInput = undefined

document.addEventListener('DOMContentLoaded', function(){
    let body =  document.querySelector('body')
    goToMoviePage()
    sort();
    if (body.classList.contains('edit-page')) {
        previewCard();
    }

    if (body.classList.contains("movie-page")){
        starsRating()
    }

    if (body.classList.value === 'index') {
        let script = document.createElement('script')
        script.src = "/GoodMovies/scripts/diaporama.js"
        document.querySelector('head').appendChild(script)
        hover()
    }
})

/**
 * Display a movie's information on hover
 */

function hover(){
    let extra = document.querySelectorAll('.extra')
    $('.poster-card').on('mouseenter', function(event){
        let i = 0;
        for (let e of extra) {
            $(e).css({'left': event.pageX - window.innerWidth, 'top': event.pageY - 270 - 295 * i})
            i++
        }
    })
}

/**
 * Color the stars on click
 */

function starsRating(){
    let div = document.querySelector('.rating')
    let stars = document.querySelectorAll('i')
    for (let s of stars){
        s.addEventListener('click', function(){
            s.nextElementSibling.checked = true
        })
    }
    div.addEventListener('click', function(e){
        if (!(e.target).classList.contains('active')){
            for (let s of stars){
                s.classList.remove('active')
            }
            (e.target).classList.add('active')
        }
    })
}

/**
 * Redirect to a movie page when a card is clicked
 */

function goToMoviePage(){
    let form = document.querySelector('.select-movie')
    let movies = document.getElementsByClassName('movie')
    for (let m of movies){
        m.addEventListener('click', function (){
            m.firstElementChild.checked = true;
            form.submit();
        })
    }
}


/**
 * Submit the form when the sort button is clicked
 */

function sort(){
    let form = document.getElementById('search-form');
    let sorts = document.querySelectorAll('.dropdown-item')
    for (let item of sorts){
        item.addEventListener('click', function(){
            item.nextElementSibling.checked = true;
            form.submit();
        })
    }
}

/**
 * Display the words count in real time, show an error if the word count > 150
 */

function countWords(){
    let display = document.querySelector('#word-count');
    let words = 0;
    if (synopsisInput.value.length > 0) words++;

    for (let i = 0; i < synopsisInput.value.length; i++){
        let char = synopsisInput.value[i];
        if (char === " " || char === "\n"){
            words++;
        }
    }
    display.innerText = "Nombre de mots:" + words + "/150";
    if (words > 150) {
        synopsisInput.classList.add('input-error')
    } else{
        synopsisInput.classList.remove('input-error')
    }
}


/**
 * Preview a movie card in real time while the user enters the movie information
 */

function previewCard(){
    let titleInput = document.querySelector('#title-input');
    let posterInput = document.querySelector('#poster-input');
    let dateInput = document.querySelector('#date-input');
    synopsisInput = document.querySelector('#synopsis-input');
    let posterSrc = document.querySelector('#image-src');

    let titleDisplay = document.querySelector('#title-display');
    let posterDisplay = document.querySelector('#poster-display');
    let dateDisplay = document.querySelector('#date-display');
    let synopsisDisplay = document.querySelector('#synopsis-display');

    titleDisplay.innerText = titleInput.value;
    if (posterSrc != null) {
        posterDisplay.src = "/GoodMovies/posters/" + posterSrc.value.toString();
    }
    let options = {year: 'numeric', month: 'long', day: 'numeric'};
    if (dateInput.value.length > 1) {
        dateDisplay.innerText = new Date(dateInput.value).toLocaleDateString("fr-FR", options);
    } else {
        dateDisplay.innerText = "Date de sortie inconnue";
    }
    synopsisDisplay.innerText = synopsisInput.value;
    countWords();

    titleInput.addEventListener('keyup',function(){
        titleDisplay.innerText = titleInput.value;
    })

    posterInput.addEventListener('change', function(){
        const [file] = posterInput.files
        if (file){
            posterDisplay.src = URL.createObjectURL(file);
        }
    })

    dateInput.addEventListener('change', function(){
        if (dateInput.value.length > 1) {
            dateDisplay.innerText = new Date(dateInput.value).toLocaleDateString("fr-FR", options);
        } else {
            dateDisplay.innerText = "Date de sortie inconnue";
        }
    })

    synopsisInput.addEventListener('keyup', function(){
        synopsisDisplay.innerText = synopsisInput.value;
        countWords();
    })
}

