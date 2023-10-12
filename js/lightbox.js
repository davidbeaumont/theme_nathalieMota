/* GESTION DE LA LIGHTBOX */

document.addEventListener('DOMContentLoaded', function() {

    function initLightbox() {
        // Récupère la lightbox
        const lightbox = document.getElementById('myLightbox');

        // Récupère l'élement qui ouvre la lightbox
        const btnsFullscreen = document.querySelectorAll('.icon-fullscreen');

        // Récupère l'élement qui ferme la lightbox
        const close = document.querySelector(".lightbox__close");

        // Fonction pour ouvrir la lightbox
        function openLightbox() {
            lightbox.style.display = "block";
        }

        // Fonction pour fermer la lightbox
        function closeLightbox() {
            lightbox.style.display = "none";
        }
        
        // Quand l'utilisateur click sur (x), ferme la lightbox
        close.onclick = closeLightbox;

        // Ajoute click event listeners sur chaque bouton
        btnsFullscreen.forEach(function(btnFullscreen) {
            btnFullscreen.addEventListener('click', function(event) {
                event.preventDefault(); // Empêche la navigation par défaut si le lien est un lien hypertexte

                // Récupère les valeurs de la photo spécifique
                const photoThumbnail = btnFullscreen.closest('.photo_block').querySelector('.photo-thumbnail');
                const imageSource = photoThumbnail.querySelector('img').src;
                const photoRef = photoThumbnail.querySelector('.image-ref').innerHTML;
                const photoCat = photoThumbnail.querySelector('.image-cat').innerHTML;

                // Crée un tableau de toutes les photos du groupe
                const photos = [];
                const photoItems = document.querySelectorAll('.photo-thumbnail');
                photoItems.forEach(function (item) {
                    const img = item.querySelector('img').src;
                    const ref = item.querySelector('.image-ref').innerHTML;
                    const cat = item.querySelector('.image-cat').innerHTML;
                    photos.push({
                        imageSource: img,
                        reference: ref,
                        categorie: cat
                    });
                });

                // Trouve l'index de la photo actuelle
                const currentPhotoIndex = photos.findIndex(function (photo) {
                    return photo.imageSource === imageSource;
                });

                remplirRef (imageSource, photoRef, photoCat, photos, currentPhotoIndex);
                openLightbox();
            });
        });
    }

    function remplirRef (imageSource, photoRef, photoCat, photos, currentPhotoIndex) {
        // Récupére les éléments à remplir automatiquement
        const lightboxImage = document.getElementById('lightboxImage');
        const lightboxReference = document.querySelector('.lightbox__reference');
        const lightboxCategorie = document.querySelector('.lightbox__categorie');

        // Rempli les éléments de la lightbox avec les données de la photo actuelle
        lightboxImage.src = imageSource;
        lightboxReference.textContent = photoRef;
        lightboxCategorie.textContent = photoCat;

        // Gestion des liens de navigation
        const prevLink = document.querySelector('.lightbox__prev');
        if (prevLink) {
            prevLink.addEventListener('click', function (event) {
                event.preventDefault();
                currentPhotoIndex--;
                if (currentPhotoIndex < 0) {
                    currentPhotoIndex = photos.length -1;
                }
                const photo = photos[currentPhotoIndex];
                remplirRef(photo.imageSource, photo.reference, photo.categorie, photos, currentPhotoIndex);
            });
        }

        const nextLink = document.querySelector('.lightbox__next');
        if (nextLink) {
            nextLink.addEventListener('click', function (event) {
                event.preventDefault();
                currentPhotoIndex++;
                if (currentPhotoIndex >= photos.length) {
                    currentPhotoIndex = 0;
                }
                const photo = photos[currentPhotoIndex];
                remplirRef(photo.imageSource, photo.reference, photo.categorie, photos, currentPhotoIndex);
            });
        }
    }

    /* GESTION FILTRES PHOTOS */

    initLightbox();
    // Fonction pour gérer l'affichage des options et la rotation de l'icône
    function toggleOptions(element) {
        var optionsDiv = element.querySelectorAll('.option');
        optionsDiv.forEach(function (option) {
            option.classList.toggle('hidden');
        });

        var iconChevron = element.querySelector('.icon-chevron');
        iconChevron.classList.toggle('rotate');
    }

    // Ajoute des gestionnaires d'événements pour chaque élément .select_categories
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
                    initLightbox();
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
                    initLightbox();
                },
            });
        });
    });


});
