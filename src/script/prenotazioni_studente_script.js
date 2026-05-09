    const classeOrigine = document.currentScript.getAttribute('data-class');
    
    document.addEventListener('DOMContentLoaded', function() {
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
});