// send the form with AJAX

var form = document.getElementById('contactForm');
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
function contactFormValidation() {
    var firstName = document.forms["contactForm"]["firstName"];
    var surname = document.forms["contactForm"]["surname"];
    var message = document.forms["contactForm"]["message"];

    if (firstName.value == "") {
        window.alert("please Enter your Name.");
        firstName.focus({ preventScroll: true });
        firstName.style.border = "ridge red"
        return false;
    }

    if (surname.value == "") {
        window.alert("please Enter your Surname.");
        surname.focus({ preventScroll: true });
        surname.style.border = "ridge red"
        return false;
    }

    if (message.value == "") {
        window.alert("The message should'nt be empty.");
        message.focus({ preventScroll: true });
        message.style.border = "ridge red"
        return false;
    }

    return true;
}