function registrationFormValidation() {
    var firstName = document.forms["registForm"]["firstName"];
    var surname = document.forms["registForm"]["surname"];
    var password = document.forms["registForm"]["password"];
    var passwordagain = document.forms["registForm"]["passwordagain"];
    var phone = document.forms["registForm"]["phone"];


    if (firstName.value == "" || firstName.value.length < 3) {
        window.alert("please Enter your Name,\n and the name should be at least 3 letters");
        firstName.focus({ preventScroll: true });
        firstName.style.border = "solid red"
        return false;
    }

    if (surname.value == "" || surname.value.length < 3) {
        window.alert("please Enter your Name,\n and the name should be at least 3 letters");
        surname.focus({ preventScroll: true });
        surname.style.border = "solid red"
        return false;
    }


    if (password.value !== passwordagain.value) {
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