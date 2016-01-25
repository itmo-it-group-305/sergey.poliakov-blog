/**
 * Created by sergeypoliakov on 25.01.16.
 */
document.addEventListener("DOMContentLoaded", function(event) {
    document.querySelector('.validate').onclick = function() {
        var pass1 = document.getElementById('user_password');
        var pass2 = document.getElementById('user_password2');
        if (pass1.value !== pass2.value) {
            alert('Check your password, dude');
            return false;
        }
    };
});

