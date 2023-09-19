document.addEventListener('DOMContentLoaded', function() {
    // Get the modal
    const modal = document.getElementById('myModal');

    // Get the buttons that open the modal
    const btns = document.querySelectorAll(".myBtn");

    // Get the <span> element that closes the modal
    const span = document.getElementsByClassName("close")[0];

    // Function to open the modal
    function openModal() {
        modal.style.display = "block";
    }

    // Function to close the modal
    function closeModal() {
        modal.style.display = "none";
    }

    // Add click event listeners to each button
    btns.forEach(function(btn) {
        btn.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche la navigation par défaut si le lien est un lien hypertexte
            openModal();
        });
    });

    // When the user clicks on <span> (x), close the modal
    span.onclick = closeModal;

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            closeModal();
        }
    }
});


/* GESTION LOAD-MORE */

jQuery(function($) {
    var page = 2; // Numéro de page initial
    var canLoad = true; // Variable pour empêcher le chargement excessif

    $('#load-more-button').click(function(e) {
        e.preventDefault();

        if (!canLoad) {
            return;
        }

        var $loadMoreButton = $('#load-more-button'); // Stockez le bouton dans une variable

        $.ajax({
            url: load_more_params.ajaxurl, // Utilisation de la variable ajaxurl
            type: 'POST',
            data: {
                action: 'load_more_posts',
                page: page,
            },
            success: function(response) {
                if (response) {
                    $('.add_photos_list').append(response);
                    page++;
                } else {
                    canLoad = false;
                    $loadMoreButton.hide(); // Masquez le bouton lorsque vous ne pouvez plus charger davantage d'articles
                }
            },
        });
    });
});
