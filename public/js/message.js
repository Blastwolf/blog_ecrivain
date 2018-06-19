window.onload = function () {
    if (document.getElementById('success') != null) {
        setTimeout(function () {
            document.getElementById('success').remove();
        }, 5000);
    }
};
