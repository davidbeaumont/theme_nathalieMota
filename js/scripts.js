/* GESTION DE LA MODALE DE CONTACT */

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


/* GESTION FILTRES PHOTOS */

document.addEventListener('DOMContentLoaded', function () {
    // Fonction pour gérer l'affichage des options et la rotation de l'icône
    function toggleOptions(element) {
        var optionsDiv = element.querySelectorAll('.option');
        optionsDiv.forEach(function (option) {
            option.classList.toggle('hidden');
        });

        var iconChevron = element.querySelector('.icon-chevron');
        iconChevron.classList.toggle('rotate');
    }

    // Ajoutez des gestionnaires d'événements pour chaque élément .select_categories
    var categoriesDiv = document.querySelector('.select_categories');
    categoriesDiv.addEventListener('click', function () {
        toggleOptions(categoriesDiv);
    });

    var formatsDiv = document.querySelector('.select_formats');
    formatsDiv.addEventListener('click', function () {
        toggleOptions(formatsDiv);
    });

    var trisDiv = document.querySelector('.select_tri');
    trisDiv.addEventListener('click', function () {
        toggleOptions(trisDiv);
    });
});

jQuery(document).ready(function ($) {
    var page = 1; // Initialise la variable page à 1
    var categorie = '';
    var format = '';
    var order = '';

    $(".select_categories .option").click(function () {
        categorie = $(this).text();
        updatePhotos();
        $(".categorie-text").html(categorie);
    });

    $(".select_formats .option").click(function () {
        format = $(this).text();
        updatePhotos();
        $(".format-text").html(format);
    });

    $(".select_tri .option").click(function () {
        order = $(this).attr('value');
        var champOrdre = $(this).text();
        updatePhotos();
        $(".tri-text").text(champOrdre);
    });

    function updatePhotos() {

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


    }


    
/* GESTION LOAD-MORE */

    $("#load-more-button").on("click", function () {
        // Incrémente la page pour charger plus de photos
        page++;

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

/* GESTION DE LA LIGHTBOX */

document.addEventListener('DOMContentLoaded', function() {
    // Get the lightbox
    const lightbox = document.getElementById('myLightbox');

    // Get the element that open the lightbox
    const btnsFullscreen = document.querySelectorAll('.icon-fullscreen');

    // Get the element that closes the lightbox
    const close = document.querySelector(".lightbox__close");

    // Function to open the lightbox
    function openLightbox() {
        lightbox.style.display = "block";
    }

    // Function to close the lightbox
    function closeLightbox() {
        lightbox.style.display = "none";
    }
    
    // When the user clicks on (x), close the lightbox
    close.onclick = closeLightbox;

    // Add click event listeners to each button
    btnsFullscreen.forEach(function(btnFullscreen) {
        btnFullscreen.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche la navigation par défaut si le lien est un lien hypertexte

                // Sélectionnez l'élément .photo-thumbnail
                const photoThumbnail = btnFullscreen.closest('.photo_block').querySelector('.photo-thumbnail');

                // Sélectionnez l'élément d'image à l'intérieur de .photo-thumbnail
                const thumbnailImage = photoThumbnail.querySelector('img');

                // Sélectionnez l'élément d'image à l'intérieur de .lightbox__image
                const lightboxImage = document.getElementById('lightboxImage');

                // Obtenez l'URL de l'image à partir de l'attribut "src" de l'image dans .photo-thumbnail
                const imageSource = thumbnailImage.getAttribute("src");

                // Mettez à jour la source de l'image dans .lightbox__image avec l'URL récupérée
                lightboxImage.src = imageSource;

                // Récupère la référence de l'image
                const photoRef = photoThumbnail.querySelector('.image-ref').innerHTML;

                // Récupère la catégorie de l'image
                const photoCat = photoThumbnail.querySelector('.image-cat').innerHTML;

                // Récupère la référence à la div avec la classe "lightbox__reference"
                const lightboxReference = document.querySelector('.lightbox__reference');
            
                // Insérez la valeur de photoRef dans la div
                lightboxReference.textContent = photoRef;

                // Récupérez la référence à la div avec la classe "lightbox__categorie"
                const lightboxCategorie = document.querySelector('.lightbox__categorie');

                // Insérez la valeur de photoRef dans la div
                lightboxCategorie.textContent = photoCat;

                // Récupère les éléments de navigation
                const prevButton = document.querySelector(".lightbox__prev");
                const nextButton = document.querySelector(".lightbox__next");

            openLightbox();
        });
    });

});