
//Wishlist page

function renderCard(card){
    console.log("rendering card");
    $("#results").removeClass('hidden');
    var table = document.getElementById("results");
    var row = table.insertRow(1);

    var localPrice = card.usd*14.75;
    localPrice = Math.ceil(localPrice);

    row.innerHTML =
        '<td>' +
        card.name +
        '</td>'+
        '<td>' +
        "$ " + card.usd +
        '</td>' +
        '<td>' +
        "R " + localPrice +
        '</td>';



}





function init(){

    $('#importTopdeck').on( "click", function() {
        event.preventDefault();
        console.log("DOING IMPROT");

        return $.ajax({
            url: 'api/importTopdeck',
            type: 'GET',
            error: function() {
            },
            success: function(data) {

                console.log(data);
                return data;
            }
        });
    });

    $('#getProductForm').on('submit', function (e) {
        e.preventDefault();
        let query = (e.currentTarget[0].value);
        console.log(query);
        $.ajax({
            url: 'api/getProduct',
            type: 'GET',
            data: {query:query},
            error: function() {
            },
            success: function(data) {

                console.log(data);
                renderCard(data);
                return data;
            }
        });
    });

    function renderCard(card){
        var table = document.getElementById("result");
        var row = table.insertRow(1);

        row.innerHTML =
            '<td>' +
            card.name +
            '</td>';

    }


}

$(document).ready(function () {
    console.log("admin doc ready!");
    init();

});
