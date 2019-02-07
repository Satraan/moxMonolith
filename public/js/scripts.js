
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

    function doScrape(target, query, value){
       return $.ajax({
            url: 'api/scrape' + target,
            type: 'GET',
            data: {query: query, value:value},
            error: function() {
            },
            success: function(data) {
                return data;
            }
        });
    }
    function singleScrape(target, query, value){
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
            https://scryfall.com/search?q=reset+-e%3Amm2&unique=cards&as=grid&order=name
            $.ajax({
                url: 'https://api.scryfall.com/cards/search?q=' + encodeURIComponent(query) + "+ -e:me1" + "+ -e:me2" + "+ -e:me3" + "+ -e:me4" + "+ -e:vma" + "+ -e:tpr" + "+ -e:pz1",
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
        var query = e.options[e.selectedIndex].text;
        var value = e.options[e.selectedIndex].value;
        var target = 'TopDeck';
        singleScrape(target, query, value);
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
        singleScrape(target, query, value);


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
        singleScrape(target, query, value);
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
        singleScrape(target, query, value);
    });
    $( '#scrapeLuckshack').on( "click", function() {
        event.preventDefault();
        $("#ajaxResult").html("").addClass('hidden');
        $("#spinner").removeClass('hidden');
        $("#results").removeClass('hidden');
        var e = document.getElementById("select-card");
        var query = e.options[e.selectedIndex].text;
        var value = e.options[e.selectedIndex].value;
        var target = 'Luckshack';
        singleScrape(target, query, value);
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

        singleScrape(target, query, value);
    });

    $( '#scrapeAll').on( "click", function() {
        event.preventDefault();
        $("#ajaxResult").html("").addClass('hidden');
        $("#spinner").removeClass('hidden');
        $("#results").removeClass('hidden');

        var e = document.getElementById("select-card");
        var query = e.options[e.selectedIndex].text;
        var value = e.options[e.selectedIndex].value;

        // $.each(retailers, function(index, value){
        //     console.log(value);
        //     doScrape(value, query);
        // });

        $.when(doScrape('TopDeck' , query, value), doScrape('SadRobot' , query, value), doScrape('Dracoti' , query, value), doScrape('Geekhome' , query, value), doScrape('UnderworldConnections' , query, value)).done(function(res1, res2, res3, res4, res5){

            $("#ajaxResult").removeClass('hidden');
            $("#spinner").addClass('hidden');

            $("#ajaxResult").append(
                "<p>"+ res1[0] + "</p>" +
                "<p>"+ res2[0] + "</p>" +
                "<p>"+ res3[0] + "</p>" +
                "<p>"+ res4[0] + "</p>" +
                "<p>"+ res5[0] + "</p>"
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



    $('.ui.dropdown').dropdown();

}

$(document).ready(function () {
    console.log("document ready!");
    init();

    var counter = 0;

    // getOracleText();
});
