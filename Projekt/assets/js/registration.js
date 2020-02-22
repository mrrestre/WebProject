const fname = document.getElementById('firstName');
const surname = document.getElementById('surname');
const password = document.getElementById('password');
const passwordagain = document.getElementById('passwordagain');
const phone = document.getElementById('phone');
const error = document.getElementById('error');

var messages = [];

function validRegistrationForm() {


    if (fname.value.length <= 2) {
        messages.push('Name must be greater than 2');
    }

    if (surname.value.length <= 2) {
        messages.push('surname must be greater than 2');
    }

    if (password.value !== passwordagain.value) {
        messages.push('the two Passwords are\'nt the same');
    }

    if (password.value.length < 6) {
        messages.push('the Password must be Min. 6');
    }

    if (password.value.length > 15) {
        messages.push('the Password must be Max. 15');
    }

    if (phone.value.toString().length < 9) {
        messages.push('the Phone Number must be MIN. 9');
    }

    if (phone.value.toString().length > 15) {
        messages.push('the Phone Number must be MAX. 15');
    }

    if (messages.length > 0) {
        event.preventDefault();
        error.innerHTML = messages.join(', ');
    }
}