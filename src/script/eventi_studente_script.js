function toggleEspansione(cardCliccata) {
  document.querySelectorAll(".card-evento").forEach((card) => {
    if (card !== cardCliccata) card.classList.remove("espansa");
  });
  cardCliccata.classList.toggle("espansa");
}
