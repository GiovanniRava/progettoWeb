function openMenu() {
  document.getElementById("sideMenuMobile").classList.add("open");
  document.body.style.overflow = "hidden"; // Blocca lo scroll della pagina sottostante
}
function closeMenu() {
  document.getElementById("sideMenuMobile").classList.remove("open");
  document.body.style.overflow = "auto"; // Ripristina lo scroll
}
