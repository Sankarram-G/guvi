$(document).ready(function() {
    $('#updateProfileForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: 'update_profile.php',
            data: formData,
            success: function(response) {
                console.log(response);
                },
            error: function(error) {
                console.error('Profile update failed:', error);
           }
        });
    });
});
