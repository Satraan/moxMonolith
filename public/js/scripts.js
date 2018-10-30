
//Wishlist page

function renderCard(card){
 console.log("rendering card");
    $("#results").removeClass('hidden');
    var table = document.getElementById("results");
    var row = table.insertRow(1);

    var localPrice = card.usd*14.5;
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

    function doScrape(target, query, value){
       return $.ajax({
            url: 'api/scrape' + target,
            type: 'GET',
            data: {query: query, value:value},
            error: function() {
            },
            success: function(data) {
                // return data;
                $("#ajaxResult").append(
                    "<p>"+ data + "</p>"
                );

                $("#ajaxResult").removeClass('hidden');
                $("#spinner").addClass('hidden');
                return data;
            }
        });
    }


    $('#select-card').selectize({
        valueField: 'id',  //What attribute of the card will be recorded as the selected value. i.e name, id, set, oracle_id
        labelField: 'name',
        searchField: 'name',
        closeAfterSelect: true,
        create: false,
        render: {
            option: function(item, escape) {
                return '<div>'
                    // +   '<img class="search-image" src="'+item.image_uris.art_crop+'" style/>'
                    +   escape(item.name)
                    +   '</div>';
            }
        },
        load: function(query, callback) {
            if (!query.length) return callback();

            $.ajax({
                url: 'https://api.scryfall.com/cards/search?unique=prints&q="' + encodeURIComponent(query) + '"',
                type: 'GET',
                dataType: 'json',
                error: function() {
                    callback();
                },
                success: function(res) {
                    var result = [];

                    $.each(res, function (key, value) {


                       console.log(this);
                    });



                    var data = res.data.slice(0,5);



                    console.log(data);
                    callback(data);
                }
            });
        }
    });
    $( '#select-card').on( "change", function() {
        event.preventDefault();
        var e = document.getElementById("select-card");
        var value = e.options[e.selectedIndex].value;

        //Prevents the call from happening if the user erases their selection
        if (!value){
            return
        } else {
            $.ajax({
                url: 'https://api.scryfall.com/cards/' + value ,
                type: 'GET',
                dataType: 'json',
                error: function() {
                    // callback();
                },
                success: function(data) {
                    console.log(data);
                    renderCard(data);

                }
            });
        }




    });

    //Scrapers
    $( '#scrapeTopDeck').on( "click", function() {
        event.preventDefault();
        $("#ajaxResult").html("").addClass('hidden');
        $("#spinner").removeClass('hidden');
        $("#results").removeClass('hidden');
        var e = document.getElementById("select-card");
        var value = e.options[e.selectedIndex].text;

        //Test scrape
        $.ajax({
            url: 'api/scrapeTopDeck',
            type: 'GET',
            data: {query: value},
            error: function() {
            },
            success: function(data) {
                $("#ajaxResult").append(
                    "<p>" + data + "</p>"
                );
                console.log(data);
            }
        });

        //Test adding cards
        // $.ajax({
        //     url: 'https://api.scryfall.com/cards/' + value ,
        //     type: 'GET',
        //     dataType: 'json',
        //     error: function() {
        //         // callback();
        //     },
        //     success: function(data) {
        //         $.ajax({
        //             url: 'api/addToWishlist',
        //             type: 'GET',
        //             data: data,
        //             error: function() {
        //             },
        //             success: function(data) {
        //                 console.log(data);
        //             }
        //         });
        //     }
        // });



        // $.ajax({
        //     url: 'https://api.scryfall.com/cards/' + value ,
        //     type: 'GET',
        //     dataType: 'json',
        //     error: function() {
        //     },
        //     success: function(data) {
        //         //Submit card for wishlist
        //         $.ajax({
        //             url: 'addToWishlist' ,
        //             type: 'GET',
        //             data: data,
        //             error: function() {
        //             },
        //             success: function(data) {
        //
        //             }
        //         });
        //     }
        // });
    });
    $( '#scrapeDracoti').on( "click", function() {
        event.preventDefault();
        $("#ajaxResult").html("").addClass('hidden');
        $("#spinner").removeClass('hidden');
        $("#results").removeClass('hidden');
        var e = document.getElementById("select-card");
        var query = e.options[e.selectedIndex].text;
        var value = e.options[e.selectedIndex].value;
        var target = 'Dracoti';
        doScrape(target, query, value);


    });

    $( '#scrapeSadRobot').on( "click", function() {
        event.preventDefault();
        $("#ajaxResult").html("").addClass('hidden');
        $("#spinner").removeClass('hidden');
        $("#results").removeClass('hidden');
        var e = document.getElementById("select-card");
        var query = e.options[e.selectedIndex].text;
        var value = e.options[e.selectedIndex].value;
        var target = 'SadRobot';
        doScrape(target, query, value);
    });
    $( '#scrapeUnderworldConnections').on( "click", function() {
        event.preventDefault();
        $("#ajaxResult").html("").addClass('hidden');
        $("#spinner").removeClass('hidden');
        $("#results").removeClass('hidden');
        var e = document.getElementById("select-card");
        var query = e.options[e.selectedIndex].text;
        var value = e.options[e.selectedIndex].value;
        var target = 'UnderworldConnections';
        doScrape(target, query, value);
    });
    $( '#scrapeGeekhome').on( "click", function() {
        event.preventDefault();
        $("#ajaxResult").html("").addClass('hidden');
        $("#spinner").removeClass('hidden');
        $("#results").removeClass('hidden');
        var e = document.getElementById("select-card");
        var query = e.options[e.selectedIndex].text;
        var value = e.options[e.selectedIndex].value;
        var target = 'Geekhome';

        doScrape(target, query, value);
    });

    $( '#scrapeAll').on( "click", function() {
        event.preventDefault();
        $("#ajaxResult").html("").addClass('hidden');
        $("#spinner").removeClass('hidden');
        $("#results").removeClass('hidden');

        var e = document.getElementById("select-card");
        var query = e.options[e.selectedIndex].text;

        var retailers = ['TopDeck' , 'SadRobot' , 'Geekhome' , 'UnderworldConnections'];

        $.each(retailers, function(index, value){
            console.log(value);
            doScrape(value, query);
        });

        $.when(doScrape('TopDeck' , query), doScrape('SadRobot' , query), doScrape('Geekhome' , query), doScrape('UnderworldConnections' , query)).done(function(res1, res2, res3, res4){

            $("#ajaxResult").removeClass('hidden');
            $("#spinner").addClass('hidden');

            $("#ajaxResult").append(
                "<p>"+ res1[0] + "</p>" +
                "<p>"+ res2[0] + "</p>" +
                "<p>"+ res3[0] + "</p>" +
                "<p>"+ res4[0] + "</p>"
            );

        });


    });

    $('#checkStock').on("click" , function () {
        event.preventDefault();

        $.ajax({
            url: 'api/checkStock',
            type: 'GET',
            error: function() {
            },
            success: function(data) {
                console.log(data);
            }
        });
    });

    $('#addToWishlist').on("click" , function () {
        event.preventDefault();
        var e = document.getElementById("select-card");
        var query = e.options[e.selectedIndex].value;

        $.ajax({
            url: 'api/addToWishlist',
            type: 'GET',
            data: {query:query},
            error: function() {
            },
            success: function(data) {
                console.log(data);
            }
        });
    });



}

$(document).ready(function () {
    console.log("document ready!");
    init();

    var counter = 0;

    // getOracleText();
});
