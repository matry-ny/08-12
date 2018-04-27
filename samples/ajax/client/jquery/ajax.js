$('form').on('submit', function () {
    var form = $(this);
    $.ajax({
        type: 'get',
        url: form.attr('action'),
        data: form.serialize(),
        success: function (answer) {
            console.log(answer);
        }
    });

    return false;
});
