/**
 * Control all forms before submitting, if there's an error the involved input is pointed out
 */


document.addEventListener('DOMContentLoaded', function(){
    let body = document.querySelector('body');

    if (body.classList.value == "login-page") loginForm()
    if (body.classList.value == "add-page") addMovieForm()
    if (body.classList.value == "edit-page") editMovieForm()
    if (body.classList.value == "movie-page") commentForm()
})

function loginForm(){
    let form = document.querySelector('#login-form');
    form.addEventListener('submit', function(event){
        event.preventDefault();

        if (form.username.value == ""){
            form.username.classList.add('input-error')
        } else {
            form.username.classList.remove('input-error')
        }

        if (form.password.value == ""){
            form.password.classList.add('input-error')
        } else {
            form.password.classList.remove('input-error')
        }

        if (form.username.value != "" && form.password.value != "") form.submit();
    })
}

function addMovieForm(){
    let form = document.querySelector('#create-form')
    form.addEventListener('submit', function (event){
        event.preventDefault()

        if (form.title.value == ""){
            form.title.classList.add('input-error')
        } else {
            form.title.classList.remove('input-error')
        }

        if (form.poster.value == ""){
            form.poster.classList.add('input-error')
        } else {
            form.poster.classList.remove('input-error')
        }

        if (form.synopsis.value == ""){
            form.synopsis.classList.add('input-error')
        } else {
            form.synopsis.classList.remove('input-error')
        }

        if (form.title.value != "" && form.poster.value != "" && form.synopsis.value != "") form.submit();
    })
}

function editMovieForm() {
    let form = document.querySelector('#edit-page-form')
    let textarea = document.querySelector('#synopsis-input')
    form.addEventListener('submit', function (event) {
        event.preventDefault()

        if (form.title.value == "") {
            form.title.classList.add('input-error')
        } else {
            form.title.classList.remove('input-error')
        }

        if (textarea.value == "") {
            textarea.classList.add('input-error')
        } else {
            textarea.classList.remove('input-error')
        }

        if (form.title.value != "" && textarea.value != "") form.submit();
    })
}


function commentForm(){
    let form = document.querySelector('#add-comment-form')
    form.addEventListener('submit', function (event) {
        event.preventDefault()

        if (form.user_nickname.value == ""){
            form.user_nickname.classList.add('input-error')
        } else{
            form.user_nickname.classList.remove('input-error')
        }

        if (form.user_email.value == "" || !validateEmail(form.user_email.value)){
            form.user_email.classList.add('input-error')
        } else{
            form.user_email.classList.remove('input-error')
        }

        if (form.comment.value == ""){
            form.comment.classList.add('input-error')
        } else{
            form.comment.classList.remove('input-error')
        }

        if (form.user_nickname.value != "" && form.user_email.value != "" && form.comment.value != "") form.submit()
    })
}

function validateEmail(mail) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) return true

    return false
}