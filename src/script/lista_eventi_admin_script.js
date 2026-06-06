document.addEventListener('DOMContentLoaded', function() {
    const finestra = document.getElementById('finestra-annulla');
    const inputNascosto = document.getElementById('input-nascosto-elimina');
    const bottoniAnnulla = document.querySelectorAll('.button-elimina-evento');
    const btnNo = document.getElementById('revoca-elimina');
    const btnSi = document.getElementById('conferma-elimina');

    bottoniAnnulla.forEach(bottone => {
        bottone.addEventListener('click', () => {
            const idDaEliminare = bottone.getAttribute('data-id');
            inputNascosto.value = idDaEliminare;
            finestra.showModal(); 
        });
    });

    btnNo.addEventListener('click', function(){
        finestra.close();
    });

    btnSi.addEventListener('click', () => {
        console.log("evento eliminato!");
        finestra.close();
    });
});