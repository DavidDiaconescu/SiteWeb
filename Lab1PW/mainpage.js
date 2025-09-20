document.addEventListener("DOMContentLoaded", function() {
  var slideIndex = 1;
  showSlides(slideIndex);

  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slides[slideIndex-1].style.display = "block";
  }

  document.querySelector(".prev").addEventListener('click', function() {
    plusSlides(-1);
  });

  document.querySelector(".next").addEventListener('click', function() {
    plusSlides(1);
  });


});

document.addEventListener('DOMContentLoaded', function() {
  var rows = document.querySelectorAll('#linkTable tr');
  var currentRow = 0;

  function displayNextRow() {
    // Ascunde toate rândurile
    rows.forEach(row => row.style.display = 'none');

    // Afișează rândul curent
    rows[currentRow].style.display = 'table-row';

    // Incrementați indexul curent și resetati dacă depășește numărul de rânduri
    currentRow = (currentRow + 1) % rows.length;
  }

  // Setează intervalul pentru a schimba rândurile
  setInterval(displayNextRow, 3000); // Schimbă rândurile la fiecare 3 secunde

  // Afișează inițial primul rând
  displayNextRow();
});
