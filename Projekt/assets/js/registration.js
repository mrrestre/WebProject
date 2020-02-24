// send the form with AJAX


var form = document.getElementById('registForm');
var submit = form.querySelector('input[type="submit"]');

submit.addEventListener('click', function(event) {
    event.stopPropagation();
    event.preventDefault();

    var request = new XMLHttpRequest();

    request.open('POST', '../../views/pages/registration.php', true);

    request.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                alert(this.responseText);
            } else {
                alert(this.responseText);
            }
        }
    }
    request.send(new FormData(form));
});

// validation the form with Javascript
function registrationFormValidation() {
    var firstName = document.forms["registForm"]["firstName"];
    var surname = document.forms["registForm"]["surname"];
    var password = document.forms["registForm"]["password"];
    var passwordagain = document.forms["registForm"]["passwordagain"];
    var phone = document.forms["registForm"]["phone"];


    if (firstName.value == "") {
        window.alert("please Enter your Name");
        firstName.focus({ preventScroll: true });
        firstName.style.border = "solid red"
        return false;
    }
    if (firstName.value.length < 3) {
        window.alert("the name should be at least 3 letters");
        firstName.focus({ preventScroll: true });
        firstName.style.border = "solid red"
        return false;
    }

    if (surname.value == "") {
        window.alert("please Enter your surname");
        surname.focus({ preventScroll: true });
        surname.style.border = "solid red"
        return false;
    }

    if (surname.value.length < 3) {
        window.alert("the surname should be at least 3 letters");
        surname.focus({ preventScroll: true });
        surname.style.border = "solid red"
        return false;
    }


    if (password.value != passwordagain.value) {
        window.alert("the Passwords must be the same");
        passwordagain.focus({ preventScroll: true });
        passwordagain.style.border = "solid red"
        return false;
    }

    if (phone.value.toString().length > 14) {
        window.alert("the Phone Number is Max. 14");
        phone.focus({ preventScroll: true });
        phone.style.border = "solid red"
        return false;
    }

    return true;
}