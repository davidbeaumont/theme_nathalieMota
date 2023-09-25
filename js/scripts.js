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
                    $('.photos_list').append(response);
                    page++;
                } else {
                    canLoad = false;
                    $loadMoreButton.hide(); // Masquez le bouton lorsque vous ne pouvez plus charger davantage d'articles
                }
            },
        });
    });
});



/* GESTION FILTRES PHOTOS */

jQuery(document).ready(function ($) {
    var page = 1; // Initialise la variable page à 1

    $(".selectors select").on("change", function () {
        // Récupére les valeurs des filtres
        var categorie = $(".select_categories").val();
        var format = $(".select_formats").val();
        var order = $(".select_tri").val();

        // Réinitialise la page à 1 lors du changement de filtres
        page = 1;

        // Envoi d'une requête AJAX
        $.ajax({
            url: load_more_params.ajaxurl, // Utilisation de la variable ajaxurl
            type: "POST",
            data: {
                action: "filter_photos",
                categorie: categorie,
                format: format,
                order: order,
                page: page,
            },
            success: function (response) {
                $(".photos_list").html(response); // Remplace le contenu existant par les nouvelles photos
            },
        });
    });

    $("#load-more-button").on("click", function () {
        // Incrémente la page pour charger plus de photos
        page++;

        // Récupére les valeurs actuelles des filtres
        var categorie = $(".select_categories").val();
        var format = $(".select_formats").val();
        var order = $(".select_tri").val();

        // Envoi une requête AJAX pour charger plus de photos
        $.ajax({
            url: load_more_params.ajaxurl, // Utilisation de la variable ajaxurl
            type: "POST",
            data: {
                action: "filter_photos",
                categorie: categorie,
                format: format,
                order: order,
                page: page,
            },
            success: function (response) {
                if (response) {
                    $(".photos_list").append(response); // Ajoute les nouvelles photos à la liste existante
                } else {
                    $("#load-more-button").hide(); // Masque le bouton s'il n'y a plus de photos à charger
                }
            },
        });
    });
});
