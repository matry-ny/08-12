document.getElementsByTagName('form').item(0).onsubmit = function (ev) {
    // var data = this.getElementsByName('data').value;
    // var t = document.getElementsByTagName('form').getElementsByTagName('data');
    console.log(serialize(this));

    // var xhr = new XMLHttpRequest();
    // xhr.open('GET', this.getAttribute('action') + '?data=');
    // xhr.onload = function() {
    //     console.log(xhr.responseText);
    // };
    // xhr.send();


    return false;
};