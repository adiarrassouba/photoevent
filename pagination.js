

// PAGINATION PAGE D'ACCUEIL et filtre
let currentPage = 1;
$('#load-more').on('click', function(event) { // Ajout d'un event listener au clic
    currentPage++; // on incrémente de 1 à chaque clique sur le bouton load more
    let selectedFormat = $('#formats').find(":selected").val();
    let selectedCategory = $('#categories').find(":selected").val();
    let selectedSortDate = $('#sort-by-date').find(":selected").val();
    $.ajax({ // On envoie une requête AJAX vers le serveur de type POST à l'URL
        url: 'http://photographie-event.local/wp-admin/admin-ajax.php',
        type: 'POST',
        data: {
            action: 'filter_photos',
            nonce: 'filter_photos',
            paged: currentPage,
            format:  selectedFormat,
            category: selectedCategory,
            sortDate: selectedSortDate
        },
        success: function(res) { // on ajoute la page suivante des publications à l'élément qui porte la classe "gallery-container".
            $('.gallery-container').append(res);
        },
        error: function(res) {
           console.log('Error');
        }
    });
});      





$( "#formats, #categories, #sort-by-date" ).on( "change", function() {
let selectedFormat = $('#formats').find(":selected").val();
let selectedCategory = $('#categories').find(":selected").val();
let selectedSortDate = $('#sort-by-date').find(":selected").val();
currentPage = 1; //au filtre on retourne a la page 1 par defaut
$.ajax({
    url: 'http://photographie-event.local/wp-admin/admin-ajax.php',
    type: 'POST',
    data: {
        action: 'filter_photos',
        nonce: 'filter_photos',
        paged: currentPage,
        format:  selectedFormat,
        category: selectedCategory,
        sortDate: selectedSortDate
    },
    success: function(res) {
        $('.gallery-container').html(res);
    },
    error: function(res) {
       console.log('Error');
    }
});
  })