/* GESTION DE LA MODALE DE CONTACT */

document.addEventListener('DOMContentLoaded', function() {
    // Récupère la modale
    const modal = document.getElementById('myModal');

    // Récupère les boutons qui ouvrent la modale
    const btns = document.querySelectorAll(".myBtn");

    // Récupère l'élément <span> qui ferme la modale
    const span = document.getElementsByClassName("close")[0];

    // Fonction pour ouvrir la modale
    function openModal() {
        modal.style.display = "block";
    }

    // Fonction pour fermer la modale
    function closeModal() {
        modal.style.display = "none";
    }

    // Ajoute des écouteurs d'événements de clic à chaque bouton
    btns.forEach(function(btn) {
        btn.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche la navigation par défaut si le lien est un lien hypertexte
            nav.classList.remove("active");
            burger.classList.remove("active");
            openModal();
        });
    });

    // Lorsque l'utilisateur clique sur <span> (x), fermer la modale
    span.onclick = closeModal;

    // Lorsque l'utilisateur clique n'importe où en dehors de la modale, la fermer
    window.onclick = function(event) {
        if (event.target == modal) {
            closeModal();
        }
    }
});

/* GESTION DE LA MINIATURE DANS SINGLE_PHOTO */

$(document).ready(function() {
    // Cache toutes les miniatures lors du chargement de la page
    $('.prev-thumbnail, .next-thumbnail').hide();

    // Gére l'affichage des miniatures au survol
    $('.prev-nav').hover(function() {
        $('.prev-thumbnail').show();
    }, function() {
        $('.prev-thumbnail').hide();
    });

    $('.next-nav').hover(function() {
        $('.next-thumbnail').show();
    }, function() {
        $('.next-thumbnail').hide();
    });
});


/* GESTION DU MENU BURGER */

const burger = document.querySelector(".burger");
const links = document.querySelectorAll(".menu-burger li");

burger.addEventListener("click", () => {
  burger.classList.toggle("active");
});

icons.addEventListener("click", () => {
  nav.classList.toggle("active");
});

links.forEach((link) => {
  link.addEventListener("click", () => {
    nav.classList.remove("active");
    burger.classList.remove("active");
  });
});