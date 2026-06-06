document.addEventListener('DOMContentLoaded', function() {
    const finestra = document.getElementById('finestra-annulla');
    const inputNascosto = document.getElementById('input-nascosto-elimina');
    const bottoniAnnulla = document.querySelectorAll('.button-annulla-prenotazione');
    const btnNo = document.getElementById('revoca-annulla');
    const btnSi = document.getElementById('conferma-annulla');

    const finestraR = document.getElementById('finestra-elimina');
    const inputNascostoR = document.getElementById('input-nascosto-elimina-richiesta');
    const bottoniElimina = document.querySelectorAll('.button-elimina-evento');
    const btnNoR = document.getElementById('revoca-elimina');
    const btnSiR = document.getElementById('conferma-elimina');

    // Funzione per aprire la finestra (trovata su w3school)
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
        console.log("Prenotazione annullata!");
        finestra.close();
    });

    bottoniElimina.forEach(bottone => {
        bottone.addEventListener('click', () => {
            const idDaEliminare = bottone.getAttribute('data-id');
            inputNascostoR.value = idDaEliminare;
            finestraR.showModal();
        });
    });

    btnNoR.addEventListener('click', function(){
        finestraR.close();
    });

    btnSiR.addEventListener('click', () => {
        console.log("Prenotazione annullata!");
        finestraR.close();
    });
});