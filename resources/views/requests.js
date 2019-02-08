let form = $('#myForm');

form.submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        dataType: 'json',
        success: function (response) {
            // Success


        },
        error: function (error) {
        }
    });
});


$.ajax({
    url: '',
    type: '',
    data: '',
    success: function (responce) {
        // Success

    },
    error: function (responce) {
    }
});

@forelse($ as $)

@empty
@endforelse