document.addEventListener("DOMContentLoaded", function() {
  const table = document.querySelector('.car-specs');
  const headers = table.querySelectorAll('.sortable'); // Schimbăm selectorul pentru a selecta doar anteturile care au clasa sortable
  const tableBody = table.querySelector('tbody');
  const rows = tableBody.querySelectorAll('tr');

  const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

  const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
      v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
  )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

  headers.forEach(th => th.addEventListener('click', () => {
    const asc = th.classList.toggle('asc');
    Array.from(rows).sort(comparer(Array.from(headers).indexOf(th), asc))
      .forEach(tr => tableBody.appendChild(tr));
  }));
});

document.addEventListener('DOMContentLoaded', function() {
  var rows = document.querySelectorAll('#linkTable tr'); // Selectează toate rândurile din tabelul cu id-ul 'linkTable'
  var currentIndex = 0; // Indexul rândului curent vizibil
  var displayTime = 3000; // Timpul în milisecunde pentru care un rând este vizibil

  function hideAllRows() {
    rows.forEach(function(row) {
      row.style.display = 'none'; // Ascunde fiecare rând
    });
  }

  function showNextRow() {
    hideAllRows(); // Ascunde toate rândurile
    rows[currentIndex].style.display = ''; // Afișează rândul curent
    currentIndex = (currentIndex + 1) % rows.length; // Actualizează indexul pentru următorul rând
  }

  setInterval(showNextRow, displayTime); // Setează un interval pentru a schimba rândurile
  showNextRow(); // Afișează primul rând imediat după încărcarea paginii
});
