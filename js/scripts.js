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
    var categoriesDiv = document.querySelector('.select_categories');
    var optionsDiv = categoriesDiv.querySelectorAll('.options');

    categoriesDiv.addEventListener('click', function () {
        optionsDiv.forEach(function (option) {
            option.classList.toggle('hidden');
        });

        var iconChevron = categoriesDiv.querySelector('.icon-chevron');
        iconChevron.classList.toggle('rotate');
        const btnsFullscreen = document.querySelectorAll('.icon-fullscreen');
        console.log(btnsFullscreen);
                    // Add click event listeners to each button
            btnsFullscreen.forEach(function(btnFullscreen) {
                btnFullscreen.addEventListener('click', function(event) {
                    console.log('bonjour');
                    event.preventDefault(); // Empêche la navigation par défaut si le lien est un lien hypertexte
                    openLightbox();
                });
            });
        
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var categoriesDiv = document.querySelector('.select_formats');
    var optionsDiv = categoriesDiv.querySelectorAll('.options');

    categoriesDiv.addEventListener('click', function () {
        optionsDiv.forEach(function (option) {
            option.classList.toggle('hidden');
        });

        var iconChevron = categoriesDiv.querySelector('.icon-chevron');
        iconChevron.classList.toggle('rotate');

    });
});

document.addEventListener('DOMContentLoaded', function () {
    var categoriesDiv = document.querySelector('.select_tri');
    var optionsDiv = categoriesDiv.querySelectorAll('.options');

    categoriesDiv.addEventListener('click', function () {
        optionsDiv.forEach(function (option) {
            option.classList.toggle('hidden');
        });

        var iconChevron = categoriesDiv.querySelector('.icon-chevron');
        iconChevron.classList.toggle('rotate');
    });
});


jQuery(document).ready(function ($) {
    var page = 1; // Initialise la variable page à 1

    $(".selectors .options").on("click", function () {
        // Récupére les valeurs des filtres
        var categorie = $(this).text();
        var format = $(".select_formats .options").text();
        var order = $(".select_tri").val();

        console.log('catégorie : '+categorie);
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

    
/* GESTION LOAD-MORE */

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
            console.log(btnFullscreen);

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
                
            openLightbox();
        });
    });

});