//Non ci va il DOMContentLoaded perché questo script è progettato per essere eseguito in modo sincrono e immediato nel momento
// esatto in cui il browser lo incontra lungo la pagina. Questo script è usato dai due php con il form.
    const classeOrigine = document.currentScript.getAttribute('data-class');
    const btnBack = document.querySelector('.back-box');
    const body = document.body;
    const btnAdd = document.querySelector('.' + classeOrigine);

    if (localStorage.getItem('statoForm') === 'aperto' && window.innerWidth < 892) {
        body.classList.add('mostra-form');
    }

    btnAdd.addEventListener('click', function(e) {
        if (window.innerWidth < 892) {
            e.preventDefault();
            body.classList.add('mostra-form');
            localStorage.setItem('statoForm', 'aperto');
        }
    });

    btnBack.addEventListener('click', function(e) {
        if (window.innerWidth < 892) {
            e.preventDefault();
            body.classList.remove('mostra-form');
            localStorage.removeItem('statoForm');
            window.history.replaceState({}, '', window.location.pathname);// Questa riga pulisce l'URL (toglie ?inviato=1) al refresh
        }
    });

    window.addEventListener('resize', function() {
        if (window.innerWidth >= 892) {
            body.classList.remove('mostra-form');
        }
    });
