$(document).ready(function() {
    $('#registrationForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'http://localhost/guvi/html/Register.php',
            data: formData,
            success: function(response) {
                console.log(response);
                $('#registrationMessage').html('<div class="alert alert-success" role="alert">Registration successful! Redirecting to login page...</div>');

                setTimeout(function() {
                    window.location.href = 'login.html';
                }, 2000);
            },
            error: function(error) {
                console.error('Registration failed:', error);
            }
        });
    });
});
