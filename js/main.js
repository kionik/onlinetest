$(document).ready(function () {
    $("form").on("submit", function (event) {
        $.ajax({
            url: "/",
            data: {
                FORM: $(this).serializeArray(),
                AJAX: 'Y'
            },
            success: function (result) {
                $('#resultTable').html(result);
            }
        });
        event.preventDefault();

    });
});