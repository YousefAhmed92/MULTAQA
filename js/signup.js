const showPasswordIcon = document.getElementById('showPasswordIcon'),
    passwordInput = document.getElementById('passwordInput'),
    openTOS = document.getElementById('openTOS'),
    tosPopUp = document.getElementById('tosPopUp'),
    closeTOS = document.getElementById('closeTOS')


showPasswordIcon.addEventListener('click', function () {
    const isPassword = passwordInput.type === 'password'

    if (isPassword) {
        passwordInput.type = 'text'
        showPasswordIcon.classList.add('fa-eye-slash')
        showPasswordIcon.classList.remove('fa-eye')
    }
    else {
        passwordInput.type = 'password'
        showPasswordIcon.classList.remove('fa-eye-slash')
        showPasswordIcon.classList.add('fa-eye')
    }

})

openTOS.addEventListener('click', function () {
    tosPopUp.style = 'top: 0'
})

closeTOS.addEventListener('click', function(){
    tosPopUp.style = 'top: 100%'
})