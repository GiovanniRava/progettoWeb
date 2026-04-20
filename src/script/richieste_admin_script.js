document.addEventListener("DOMContentLoaded", function () {
  const bottoniToggle = document.querySelectorAll(".toggle-btn");

  bottoniToggle.forEach((bottone) => {
    bottone.addEventListener("click", function () {
      const rigaPrincipale = this.closest(".riga-principale");

      const rigaDettagli1 = rigaPrincipale.nextElementSibling;
      const rigaDettagli2 = rigaDettagli1.nextElementSibling;

      const isNascosta = rigaDettagli1.classList.contains("nascosta");

      if (isNascosta) {
        rigaDettagli1.classList.remove("nascosta");
        rigaDettagli2.classList.remove("nascosta");
        this.innerHTML = "&#708;"; // Freccia in su
      } else {
        rigaDettagli1.classList.add("nascosta");
        rigaDettagli2.classList.add("nascosta");
        this.innerHTML = "&#709;"; // Freccia in giù
      }
    });
  });

  // --- LOGICA RIFIUTA ---
  const dialogRifiuta = document.getElementById("finestra-rifiuta");
  const inputNascostoRifiuta = document.getElementById(
    "input-nascosto-rifiuta",
  );
  const btnAnnullaRifiuto = document.getElementById("annulla-rifiuto");
  const bottoniRifiuta = document.querySelectorAll(".btn-rifiuta");

  bottoniRifiuta.forEach((bottone) => {
    bottone.addEventListener("click", function () {
      const idRichiesta = this.getAttribute("data-id");
      inputNascostoRifiuta.value = idRichiesta;
      dialogRifiuta.showModal();
    });
  });

  btnAnnullaRifiuto.addEventListener("click", function () {
    dialogRifiuta.close();
    inputNascostoRifiuta.value = ""; // Pulizia
  });

  // --- LOGICA ACCETTA (Senza Dialog) ---
  const formAccetta = document.getElementById("form-accetta-richiesta");
  const inputNascostoAccetta = document.getElementById(
    "input-nascosto-accetta",
  );
  const bottoniAccetta = document.querySelectorAll(".btn-accetta");

  bottoniAccetta.forEach((bottone) => {
    bottone.addEventListener("click", function () {
      const idRichiesta = this.getAttribute("data-id");
      inputNascostoAccetta.value = idRichiesta;
      formAccetta.submit();
    });
  });
});
