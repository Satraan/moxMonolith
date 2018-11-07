$(document).ready(function () {

    $('#addToWishlist').on("click", function () {
        event.preventDefault();
        var e = document.getElementById("select-card");
        var query = e.options[e.selectedIndex].value;

        $.ajax({
            url: 'api/addToWishlist',
            type: 'POST',
            data: {query: query},
            error: function () {
            },
            success: function (data) {
                console.log(data);
            }
        });
    });





});
