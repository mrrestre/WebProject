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