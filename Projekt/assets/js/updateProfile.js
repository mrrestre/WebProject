// validation the form with Javascript
function updatePassFormValidation() {
    var pass = document.forms["passwordForm"]["newPassword"];
    var pass_2 = document.forms["passwordForm"]["repeatPassword"];

    if (pass.value !== pass_2.value) {
        window.alert("the Passwords are not the same!");
        pass_2.focus({ preventScroll: true });
        pass_2.style.border = "solid red"
        return false;
    }

    return true;

}