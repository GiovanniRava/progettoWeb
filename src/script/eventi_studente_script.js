function toggleEspansione(cardCliccata) {
  const isExpanded = cardCliccata.classList.contains("espansa");
  
  document.querySelectorAll(".card-evento").forEach((card) => {
    card.classList.remove("espansa");
    card.setAttribute("aria-expanded", "false");
    const desc = card.querySelector(".descrizione-evento");
    if (desc) desc.setAttribute("aria-hidden", "true");
  });

  if (!isExpanded) {
    cardCliccata.classList.add("espansa");
    cardCliccata.setAttribute("aria-expanded", "true");
    const desc = cardCliccata.querySelector(".descrizione-evento");
    if (desc) desc.setAttribute("aria-hidden", "false");
  }
}
