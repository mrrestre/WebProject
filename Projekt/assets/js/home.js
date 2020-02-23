function toggleFilter() {
    var x = document.getElementById("filter");
    if (x.style.display === "none") {
        x.style.display = "flex";
    } else {
        x.style.display = "none";
    }
}

var form = document.getElementsByClassName('formfilter');
var submit = filter.querySelector('input[type="submit"]');

submit.addEventListener('click', function(event) {
    event.stopPropagation();
    event.preventDefault();

    var request = new XMLHttpRequest();
    request.open('GET', 'index.php?ajax=1', true);

    request.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                alert(this.responseText);
            } else {
                alert(this.statusText);
            }
        }
    }

    request.send(new FormData(form));
});