$('document').ready(function () {
    addEventsListeners();
});


function addEventsListeners () {
    $('.catalog-nav li').on('click', displayGood);
}

function displayGood() {
    $('.catalog-nav li').css('list-style', 'none');
    $.ajax({
        url: 'tablegen.php',
        cache: false,
        type: 'post',
        dataType: 'json',
        data: {
            table_name: $(this).id
        },
        success: function(data){
            data = JSON.parse(data);
            console.log(data);
        }
    });
    $(this).css('list-style', 'disc');
}