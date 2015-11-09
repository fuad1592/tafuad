(function (a, b) {
    if (typeof b.pushState != 'undefined') {
        var xhr, tempTitle = '';
        if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
        else xhr = new ActiveXObject("Microsoft.XMLHTTP");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var f = xhr.response,
                    parser = document.createElement('div');
                parser.innerHTML = f;
                document.querySelector('#content-load').innerHTML = parser.querySelector('#content-load').innerHTML;
                document.title = parser.querySelector('title').innerHTML;
            }
        }
        window.loadContent = function (state) {
            xhr.open('GET', document.location.toString(), true);
            xhr.send();
        }
        window.onpopstate = window.loadContent;
        var links = a.querySelectorAll('nav ul li a#push');
        for (i = 0; i < links.length; i++) {
            links[i].onclick = function (event) {
                document.querySelector('#content-load').innerHTML = 'Loading Content...';
                xhr.open('GET', this.href, true);
                xhr.send();
                a.title = this.title;
                b.pushState('', this.title, this.href);
                event.preventDefault();
                return false;
            }
        }
    } else {
        alert('Maaf, browser anda tidak support dengan Manipulasi Browser');
    }
})(document, window.history);