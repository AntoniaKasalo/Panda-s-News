
alert("User logged out");

setTimeout(function(){
    var alertBox = document.querySelector('.alert');
    alertBox.style.display = 'none';
}, 3000);

window.location.href = "index.php";
