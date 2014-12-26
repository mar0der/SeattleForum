$(function () {

    $.get('/dashboard/xhrGetListings', function (o) {
        for (var i = 0; i < o.length; i++)
        {
            $('#listInserts').append('<div>' + o[i].text + '<a class="del" rel="' + o[i].dataid + '" href="#">X</a></div>');
        }

        $(document).on('click', '.del', function () {
            delItem = $(this);
            var id = $(this).attr('rel');
            $.post('/dashboard/xhrDeleteListing', {'id': id}, function (o) {
                delItem.parent().remove();
            }, 'json');
            return false;
        });
    }, 'json');

    $('#randomInsert').submit(function () {
        var url = $(this).attr('action');
        var data = $(this).serialize();
        if (data == 'text=') {
            alert("Please enter some text!");
            return false;
        }
        $.post(url, data, function (o) {
            $('#listInserts').append('<div>' + o.text + '<a class="del" rel="' + o.id + '" href="#">X</a></div>');
            $('#inputText').val('');
        }, 'json');
        return false;
    });

});