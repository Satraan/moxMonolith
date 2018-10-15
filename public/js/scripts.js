
//Wishlist page

function renderCard(card){
 console.log("rendering card");

    var table = document.getElementById("results");
    var row = table.insertRow(1);

    row.innerHTML =
        '<td>' +
            card.name +
        '</td>'+
        '<td>' +
            "$ " + card.usd +
        '</td>';



}

function init(){

    function doScrape(target, query, value){
        $.ajax({
            url: 'api/scrape' + target,
            type: 'GET',
            data: {query: query, value:value},
            error: function() {
            },
            success: function(data) {
                $("#ajaxResult").append(
                    "<p>"+ data + "</p>"
                );
                console.log(data);
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
                url: 'https://api.scryfall.com/cards/search?q="' + encodeURIComponent(query) + '"',
                type: 'GET',
                dataType: 'json',
                error: function() {
                    callback();
                },
                success: function(res) {
                    var data = res.data.slice(0,5);
                    //data.push({"name":"Refine your search for more options", "image_uris": {"art_crop":"https://m.media-amazon.com/images/I/A19stAC0VZL._CLa%7C2140,2000%7C61Zk3HEMGTL.png%7C0,0,2140,2000+648.0,529.0,809.0,971.0._UX679_.png"}, "id":"Nope"});
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
    $( '#scrapeSadRobot').on( "click", function() {
        event.preventDefault();
        var e = document.getElementById("select-card");
        var query = e.options[e.selectedIndex].text;
        var target = 'SadRobot';
        doScrape(target, query);
    });
    $( '#scrapeGeekhome').on( "click", function() {
        event.preventDefault();
        var e = document.getElementById("select-card");
        var query = e.options[e.selectedIndex].text;
        var value = e.options[e.selectedIndex].value;
        var target = 'Geekhome';

        doScrape(target, query, value);
    });
    $( '#scrapeAll').on( "click", function() {
        event.preventDefault();
        var e = document.getElementById("select-card");
        var query = e.options[e.selectedIndex].text;

        var retailers = ['TopDeck' , 'SadRobot' , 'Geekhome'];

        $.each(retailers, function(index, value){
            console.log(value);
            doScrape(value, query);
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




function getOracleText() {
    console.log("getting text");
    var request = $.ajax({
        url: "https://cloudproject-217611.appspot.com/api/cards",
        success: function (result) {
            console.log(result);
            $('#oracle-text').html(result);
        }
    });

}

$(document).ready(function () {
    console.log("document ready!");
    init();

    // getOracleText();
});
