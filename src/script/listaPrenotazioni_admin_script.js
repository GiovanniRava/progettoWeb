document.addEventListener('DOMContentLoaded', function() {
    const bottoniToggle = document.querySelectorAll('.toggle-btn');

    bottoniToggle.forEach(bottone => {
        bottone.addEventListener('click', function() {
            const rigaPrincipale = this.closest('.riga-principale');
            const rigaDettagli1 = rigaPrincipale.nextElementSibling;
            const rigaDettagli2 = rigaDettagli1.nextElementSibling;
            
            const isNascosta = rigaDettagli1.classList.contains('nascosta');

            if (isNascosta) {
                rigaDettagli1.classList.remove('nascosta');
                rigaDettagli2.classList.remove('nascosta');
                this.innerHTML = '&#708;'; 
            } else {
                rigaDettagli1.classList.add('nascosta');
                rigaDettagli2.classList.add('nascosta');
                this.innerHTML = '&#709;'; 
            }
        });
    });

    const finestra = document.getElementById('finestra-annulla');
    const inputNascosto = document.getElementById('input-nascosto-elimina');
    const bottoniElimina = document.querySelectorAll('.button-elimina-prenotazione');
    const btnNo = document.getElementById('revoca-annulla');
    const btnSi = document.getElementById('conferma-annulla');

    bottoniElimina.forEach(bottone => {
        bottone.addEventListener('click', () => {
            const idDaEliminare = bottone.getAttribute('data-id');
            inputNascosto.value = idDaEliminare;
            finestra.showModal(); 
        });
    });

    btnNo.addEventListener('click', function(){
        finestra.close();
        inputNascosto.value = ''; 
    });
});