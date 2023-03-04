$(function() {
    $('#search-form').submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: '/search',
            method: 'GET',
            data: {
                term: $('#search-term').val()
            },
            success: function(response) {
                $('#search-results').html(response);
            },
            error: function(xhr, status, error) {
                console.log('Erreur lors de la recherche : ' + error);
            }
        });
    });
});