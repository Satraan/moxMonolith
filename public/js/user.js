
function viewWishlist() {

    $('.js-update-wishlist').on("click", function () {
        event.preventDefault();

        var wishlistId = document.getElementById("wishlistId").value;
        var title = document.getElementById("wishlistTitle").value;


        $.ajax({
            url: '../../../api/updateWishlist',
            type: 'POST',
            data: {title: title, wishlistId:wishlistId},
            error: function () {
            },
            success: function (data) {
                console.log(data);
            }
        });
    });
}






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

    viewWishlist();

});
