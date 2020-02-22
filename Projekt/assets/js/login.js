function validLoginForm(event) {
    var email = document.getElementById('email');
    var password = document.getElementById('password');
    var passLength = password.toString().length;


    function validEmail(email) {

        var strReg = "^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$";

        var regex = new RegExp(strReg);

        return (regex.test(email.value));
    }

    if (!validEmail() || (passLength < 6)) {
        Event.preventDefault();
        document.getElementById('toJS').innerHTML = " Pleas give a valid e-Mail ";
        document.getElementById('toJS2').innerHTML = " the Passwort is min. 6 ";
        return false;
    } else {
        return true;
    }
}