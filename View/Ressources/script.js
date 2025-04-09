document.addEventListener('DOMContentLoaded', function () {
  // Vérifie si le conteneur swiper existe
  if (null === document.querySelector('.swiper-container')) {
    return;
  }

  const swiperWrapper = document.querySelector('.swiper-wrapper');
  const slides = document.querySelectorAll('.swiper-slide');
  const nextButton = document.querySelector('.swiper-button-next');
  const prevButton = document.querySelector('.swiper-button-prev');
  let currentIndex = 0; // L'index du slide actuel
  const totalSlides = slides.length;

  // Fonction pour changer de slide
  function changeSlide(index) {
      // Si l'index est inférieur à 0, on revient au dernier slide
      if (index < 0) {
          currentIndex = totalSlides - 1;
      }
      // Si l'index est supérieur ou égal au nombre de slides, on revient au premier slide
      else if (index >= totalSlides) {
          currentIndex = 0;
      } else {
          currentIndex = index;
      }

      // Applique une transformation pour faire défiler le slider
      swiperWrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
  }

  // Fonction pour démarrer le défilement automatique
  let autoSlideInterval;
  function startAutoSlide() {
      autoSlideInterval = setInterval(function () {
          changeSlide(currentIndex + 1);
      }, 8000); // Défilement toutes les 8 secondes
  }

  // Fonction pour arrêter le défilement automatique
  function stopAutoSlide() {
      clearInterval(autoSlideInterval);
  }

  // Navigation vers le slide suivant
  nextButton.addEventListener('click', function () {
      changeSlide(currentIndex + 1);
      stopAutoSlide(); // Arrête le défilement automatique
      startAutoSlide(); // Redémarre le défilement automatique
  });

  // Navigation vers le slide précédent
  prevButton.addEventListener('click', function () {
      changeSlide(currentIndex - 1);
      stopAutoSlide(); // Arrête le défilement automatique
      startAutoSlide(); // Redémarre le défilement automatique
  });

  // Initialiser le slider au début
  changeSlide(currentIndex);
  startAutoSlide(); // Démarre le défilement automatique
});



/* END SLIDER REAL*/

/* Script pour la notation par étoiles*/

// Script pour la notation par étoiles
// Assurez-vous que ce code n'est exécuté qu'après le chargement du DOM
document.addEventListener('DOMContentLoaded', function () {
  const stars = document.querySelectorAll('.star'); // Déclaration unique
  let selectedRating = 0;

  stars.forEach(star => {
    star.addEventListener('click', () => {
      selectedRating = star.getAttribute('data-value');
      updateStars();
    });

    star.addEventListener('mouseover', () => {
      highlightStars(star.getAttribute('data-value'));
    });

    star.addEventListener('mouseout', () => {
      resetStars();
    });
  });

  function updateStars() {
    stars.forEach(star => {
      if (star.getAttribute('data-value') <= selectedRating) {
        star.classList.add('selected');
      } else {
        star.classList.remove('selected');
      }
    });
    document.getElementById('selected-rating').value = selectedRating;
  }

  function highlightStars(value) {
    stars.forEach(star => {
      if (star.getAttribute('data-value') <= value) {
        star.classList.add('selected');
      } else {
        star.classList.remove('selected');
      }
    });
  }

  function resetStars() {
    stars.forEach(star => {
      if (star.getAttribute('data-value') > selectedRating) {
        star.classList.remove('selected');
      }
    });
  }
});


/* End Script pour la notation par étoiles*/

// Ouverture de l'image dans galerie
document.addEventListener('DOMContentLoaded', function () {
  if (null === document.querySelector('.gallery')) {
    return;
  }

  // Récupérer toutes les images de la galerie
  const images = document.querySelectorAll('.gallery-image');
  const modal = document.getElementById('imageModal');
  const modalImage = document.getElementById('modalImage');
  const closeModal = document.getElementById('closeModal');

  // Ajouter un événement de clic sur chaque image pour ouvrir la modale
  images.forEach(image => {
    image.addEventListener('click', () => {
      modal.style.display = "block"; // Afficher la modale
      modalImage.src = image.src; // Définir l'image dans la modale
    });
  });

  // Ajouter un événement de clic pour fermer la modale
  closeModal.addEventListener('click', () => {
    modal.style.display = "none"; // Cacher la modale
  });

  // Fermer la modale si l'utilisateur clique en dehors de l'image
  window.addEventListener('click', (event) => {
    if (event.target === modal) {
      modal.style.display = "none"; // Cacher la modale
    }
  });
});


/*Responsive navbar*/
function toggleMenu() {
  const navLinks = document.querySelector('.nav-links');
  const hamburger = document.querySelector('.hamburger');

  // Basculer la classe active sur les liens de navigation
  navLinks.classList.toggle('active');

  // Cacher le hamburger lorsque le menu est actif
  if (navLinks.classList.contains('active')) {
    hamburger.style.display = 'none'; // Cacher le hamburger
  } else {
    hamburger.style.display = 'block'; // Afficher le hamburger si le menu est fermé
  }
}

// Ajoute un événement au hamburger pour ouvrir/fermer le menu
document.querySelector('.hamburger').addEventListener('click', function(event) {
  event.stopPropagation(); // Empêche la propagation de l'événement
  toggleMenu();
});

// Ajoute un événement pour fermer le menu lorsqu'on clique en dehors
document.addEventListener('click', function(event) {
  const navLinks = document.querySelector('.nav-links');
  const hamburger = document.querySelector('.hamburger');

  // Vérifier si le clic est en dehors du menu et du hamburger
  if (navLinks.classList.contains('active') && !navLinks.contains(event.target) && !hamburger.contains(event.target)) {
    navLinks.classList.remove('active'); // Fermer le menu
    hamburger.style.display = 'block'; // Afficher le hamburger
  }
});
