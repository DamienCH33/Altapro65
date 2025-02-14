/* SLIDER REAL*/

document.addEventListener('DOMContentLoaded', function () {
  const swiperWrapper = document.querySelector('.wrapper');
  const slides = document.querySelectorAll('.swiper-slide');
  const nextButton = document.querySelector('.button-next');
  const prevButton = document.querySelector('.button-prev');
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
      swiperWrapper.style.transform = `translateX(-${currentIndex * 100}vw)`;
  }

  // Navigation vers le slide suivant
  nextButton.addEventListener('click', function () {
      changeSlide(currentIndex + 1);
  });

  // Navigation vers le slide précédent
  prevButton.addEventListener('click', function () {
      changeSlide(currentIndex - 1);
  });

  // Défilement automatique du slider toutes les 5 secondes
  setInterval(function () {
      changeSlide(currentIndex + 1);
  }, 8000); // 8000ms = 5 secondes

  // Initialiser le slider au début
  changeSlide(currentIndex);
});

/* END SLIDER REAL*/

/* Script pour la notation par étoiles*/

// Script pour la notation par étoiles
const stars = document.querySelectorAll('.star');
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

// Script pour ajouter un commentaire
const commentForm = document.getElementById('commentForm');
const commentText = document.getElementById('comment-text');
const commentsList = document.getElementById('comments-list');

commentForm.addEventListener('submit', (event) => {
  event.preventDefault();

  // Récupération du texte et de la note
  const text = commentText.value;
  const rating = selectedRating;

  if (text && rating) {
    // Créer un nouvel élément de commentaire
    const newComment = document.createElement('div');
    newComment.classList.add('comment');
    newComment.innerHTML = `
      <p><strong>Utilisateur anonyme</strong> : ${text}</p>
      <p>Évaluation: ${'★'.repeat(rating)}${'☆'.repeat(5 - rating)}</p>
    `;

    // Ajouter le commentaire à la liste
    commentsList.appendChild(newComment);

    // Réinitialiser le formulaire
    commentText.value = '';
    selectedRating = 0;
    updateStars();
  }
});

/* End Script pour la notation par étoiles*/

// Ouverture de l'image dans galerie
document.addEventListener('DOMContentLoaded', function () {
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

