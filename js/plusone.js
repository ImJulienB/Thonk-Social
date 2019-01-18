$(function() {
    $(".plusOne").click(function() {
        $.ajax({
            type: "POST",
            url: "php/plusone.php",
            data: {
                id: $(this).attr('data-id')
            },
            cache: false,
            success: function(html) {
                location.reload();
            }
        });
    })
});