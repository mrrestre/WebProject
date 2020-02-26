function addArticleFormValidation() {

    var title = document.forms["addArticle"]["title"];
    var teaser = document.forms["addArticle"]["teaser"];
    var content = document.forms["addArticle"]["content"];
    var price = document.forms["addArticle"]["price"];
    var imageName = document.forms["addArticle"]["imageName"];

    if (title.value.length > 70) {
        window.alert("the Title should be shorter than 35 letters");
        title.focus({ preventScroll: true });
        title.style.border = "solid red"
        return false;
    }

    if (teaser.value.length > 150) {
        window.alert("the Teaser should be shorter than 150 letters");
        teaser.focus({ preventScroll: true });
        teaser.style.border = "solid red"
        return false;
    }

    if (content.value.length > 5000) {
        window.alert("the content is too long, Max. 5000 letters");
        content.focus({ preventScroll: true });
        content.style.border = "solid red"
        return false;
    }
    if (imageName.value = "") {
        window.alert("the image name can not be empty");
        imageName.focus({ preventScroll: true });
        imageName.style.border = "solid red"
        return false;
    }

    return true;
}