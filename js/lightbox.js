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
            openLightbox();
        });
    });

    // Sélectionnez l'élément .photo-thumbnail
    const photoThumbnail = document.querySelector(".photo-thumbnail");

    // Sélectionnez l'élément d'image à l'intérieur de .photo-thumbnail
    const thumbnailImage = photoThumbnail.querySelector("img");

    // Sélectionnez l'élément d'image à l'intérieur de .lightbox__image
    const lightboxImage = document.getElementById("lightboxImage");

    
    // Obtenez l'URL de l'image à partir de l'attribut "src" de l'image dans .photo-thumbnail
    const imageSource = thumbnailImage.getAttribute("src");
    
    // Mettez à jour la source de l'image dans .lightbox__image avec l'URL récupérée
    lightboxImage.src = imageSource;

});