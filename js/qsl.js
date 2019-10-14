
function wikiInfo(data) {

    console.log(data);
    console.log(data.query.pages);
    var obj = data.query.pages;
    var wikiInfo = Object.values(obj)[0].extract


    $(".wikipedia").append(
        $('<section class="record">').append(
            $('<p>').text(wikiInfo)
        )
    );

}





$(document).ready(function () {

    var data = {
        resource_id: "f5ecd45e-7730-4517-ad29-73813c7feda8",
        limit: 50
    }

    $.ajax({
        url: "https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro=1&explaintext=1&titles=thorny%20devil",
        // data: data,
        dataType: "jsonp", // We use "jsonp" to ensure AJAX works correctly locally (otherwise XSS).
        cache: true,
        success: function (data) {
            wikiInfo(data);
        }
    });

});