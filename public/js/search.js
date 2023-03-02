$(document).ready(function() {
    $('#search-input').keyup(function() {
        var searchQuery = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/plannification/search',
            data: {
                search: searchQuery
            },
            success: function(data) {
                // Mettre à jour la page avec les résultats de la recherche
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Une erreur s\'est produite lors de la recherche:', textStatus, errorThrown);
            }
        });
    });
});