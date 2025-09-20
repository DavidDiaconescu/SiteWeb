document.addEventListener("DOMContentLoaded", function() {
  var usernameInput = document.getElementById("username");
  var carModelInput = document.getElementById("car_model");
  var passwordInput = document.getElementById("password");
  var emailInput = document.getElementById("email");
  var phoneNumberInput = document.getElementById("phone_number");

  // Adăugarea listenerelor pentru fiecare input
  usernameInput.addEventListener("input", function() {
    validateInput(this, document.getElementById("username-status"), /^[a-z0-9]+$/);
  });

  carModelInput.addEventListener("input", function() {
    validateInput(this, document.getElementById("car-model-status"), /^[a-z0-9]+$/);
  });

  passwordInput.addEventListener("input", function() {
    validatePassword(this, document.getElementById("password-status"));
  });

  emailInput.addEventListener("input", function() {
    validateEmail(this, document.getElementById("email-status"));
  });

  phoneNumberInput.addEventListener("input", function() {
    validatePhoneNumber(this, document.getElementById("phone-status"));
  });

  // Funcții de validare
  function validateInput(inputElement, statusElement, regex) {
    if (regex.test(inputElement.value)) {
      statusElement.style.display = "inline-block";
      statusElement.style.backgroundColor = "green";
    } else {
      statusElement.style.display = "inline-block";
      statusElement.style.backgroundColor = "red";
    }
  }

  function validatePassword(inputElement, statusElement) {
    var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!]).+$/;
    if (regex.test(inputElement.value)) {
      statusElement.style.display = "inline-block";
      statusElement.style.backgroundColor = "green";
    } else {
      statusElement.style.display = "inline-block";
      statusElement.style.backgroundColor = "red";
    }
  }

  function validateEmail(inputElement, statusElement) {
    var regex = /^[a-zA-Z0-9_]+@[a-zA-Z0-9_]+\.[a-zA-Z0-9_.]+$/;
    if (regex.test(inputElement.value) && (inputElement.value.match(/@/g) || []).length === 1) {
      statusElement.style.display = "inline-block";
      statusElement.style.backgroundColor = "green";
    } else {
      statusElement.style.display = "inline-block";
      statusElement.style.backgroundColor = "red";
    }
  }

  function validatePhoneNumber(inputElement, statusElement) {
    var regex = /^\(\+40\) \d{3} \d{3} \d{3}$/; // Regex for phone number format
    if (regex.test(inputElement.value)) {
      statusElement.style.display = "inline-block";
      statusElement.style.backgroundColor = "green"; // Phone number is valid
    } else {
      statusElement.style.display = "inline-block";
      statusElement.style.backgroundColor = "red"; // Phone number is not valid
    }
  }

  function formatBirthDate(input) {
    var rawDate = input.value;
    var statusElement = document.getElementById('birth-date-status');

    // Verifică dacă lungimea este exact 8 caractere și conține doar cifre
    if (rawDate.length === 8 && /^\d{8}$/.test(rawDate)) {
      var day = rawDate.substring(0, 2);
      var month = rawDate.substring(2, 4);
      var year = rawDate.substring(4, 8);

      // Construiește data în format nou
      var formattedDate = `${day}/${month}/${year}`;
      input.value = formattedDate;  // Actualizează valoarea input-ului cu data formatată

      statusElement.style.display = "inline-block";
      statusElement.style.backgroundColor = "green"; // Data este validă
    } else {
      statusElement.style.display = "inline-block";
      statusElement.style.backgroundColor = "red"; // Data nu este validă
    }
  }

  document.addEventListener("DOMContentLoaded", function() {
    const countySelect = document.getElementById('county-select');
    const citySelect = document.getElementById('city-select');

    const data = {
      'Alba': ['Alba Iulia', 'Aiud', 'Blaj', 'Sebeș'],
      'Arad': ['Arad', 'Lipova', 'Ineu'],
      // Adaugă restul județelor și orașelor aici...
    };

    for (const county in data) {
      let option = document.createElement('option');
      option.value = county;
      option.text = county;
      countySelect.appendChild(option);
    }

    countySelect.onchange = function() {
      citySelect.innerHTML = '<option>Selectează un oraș</option>';
      let cities = data[countySelect.value];

      if (cities) {
        citySelect.disabled = false;
        cities.forEach(city => {
          let option = document.createElement('option');
          option.value = city;
          option.text = city;
          citySelect.appendChild(option);
        });
      } else {
        citySelect.disabled = true;
      }
    };
  });


});
