$('document').ready(function () {
    addEventsListeners();
    var strGET = window.location.search.replace( '?', '');
    if (strGET.length > 4 && strGET.slice(0, 4) ==='item') {
        strGET = strGET.replace('item=', '');
        try {
            $(`[id = ${strGET}]`).trigger('click');

        } catch (err) {
            window.location = `catalog`;
        }
    }
    else if (location.pathname.split("/").slice(-1)[0] === 'catalog.html'){
        $(`[id = 'packing']`).trigger('click');
    }
});


function addEventsListeners () {
    $('.catalog-nav li').on('click', displayGood);
    $('.detail').on('click', showOnCatalog);
    $('.logo').on('click', function () {
        window.location = `index.html`;
    });
	$('#show-cert').on('click', showCert);
}

function displayGood() {
    $('.catalog-nav li').css('list-style', 'none');
    var table_name = $(this).attr('id');
    $.ajax({
        url: 'tablegen.php',
        cache: false,
        type: 'post',
        dataType: 'json',
        data: {
            table_name: table_name
        },
        success: function(data){
          var table = `<table><tr>`;
          var headers = Object.keys(data[0]);
          delete headers[0];
          headers.forEach(function (current) {
            table += `<th>${current}</th>`;
          });
          table += `</tr>`;
          for (var row in data) {
            table += `<tr>`;
            for (var cell in data[row]) {
              if (cell !== 'id') {
                table += `<td>${data[row][cell]}</td>`;
              }
            }
            table += `</tr>`;
          }
      table +=`</table>`;
          table = table.replace(/null/gi, '-');
      $('.catalog-field').html(table);
       },
        error: function (jqXHR, exception) {
            console.log(jqXHR, exception);
        }
    });
    $(this).css('list-style', 'disc');
}

function showOnCatalog() {

    var elem = $(this).attr('id');
    elem = elem.replace('.', '');
    window.location = `catalog.html?item=${elem}`;
};

$("form").on("submit", function (e) {
    e.preventDefault();
    var validation_settings
    if ($(this).validate({
        rules: {
            name: 'required',
            message: 'required',
            email: {
              required: true,
              email: true,
            },
          },
          messages: {
            name: 'Это поле обязательно для заполнения',
            message: 'Это поле обязательно для заполнения',
            email: 'Введите существующий e-mail',
          },
        })) {
        $.ajax({
            type: "post",
            url: "contact.php",
            data: $("input, textarea").serialize(),
            success: function(data) {
                alert( "Сообщение успешно отправлено" );
                console.log(data);
            }
        })
    }
});

function showCert () {
	$('.wrapper').css('display', 'flex');
	$('.wrapper').on('click', function(event){
        if (event.target === $(this)[0]){
            console.log(event.target);
            $('.wrapper').hide();
        }
    });
}

