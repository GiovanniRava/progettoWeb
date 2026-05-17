<div class="table-container">
    <table class="table-prenotazioni-studente">
        <thead>
            <tr>
                <th id="numero-aula-lab">AULA / LAB</th>
                <th id="data-prenotazione">DATA</th>
                <th id="ora-prenotazione">ORARIO</th>
                <th id="sezione-annulla"></th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($templateParams["prenotazioni"])): ?>
                <?php if($templateParams["richieste_utente"] == 0): ?>
                    <tr>
                        <td colspan="4">Nessuna prenotazione in programma.</td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Hai <?= $templateParams["richieste_utente"] ?> richieste pendenti. Attendi che admin le accetti.</td>
                    </tr>
                <?php endif; ?>  
            <?php else:
                foreach($templateParams["prenotazioni"] as $prenotazione):
                $dataFormattata = date("d/m/Y", strtotime($prenotazione["data"])); ?>
                <tr>
                    <td headers="numero-aula-lab"><?php echo $prenotazione["num"]; ?></td>
                    <td headers="data-prenotazione"><?php echo $dataFormattata; ?></td>
                    <td headers="ora-prenotazione"><?php $oraInizio = date("H:i", strtotime($prenotazione["oraInizio"])); echo $oraInizio; ?> - 
                    <?php $date = new DateTime($prenotazione["oraInizio"]);
                        $date->modify("+{$prenotazione["durata"]} minutes");
                        $oraFine = $date->format('H:i'); 
                        echo $oraFine;
                    ?></td>
                    <td headers="sezione-annulla">
                        <button class="button-annulla-prenotazione" data-id="<?php echo $prenotazione["codicePre"]; ?>">ANNULLA</button>
                        <!--non uso id perchè superfluo in questo caso-->
                    </td>
                </tr>
                <?php endforeach;
            endif; ?>
            <dialog id="finestra-annulla">
                <h4>ANNULLAMENTO PRENOTAZIONE</h4>
                <form id="form-elimina-prenotazione" action="prenotazioni_studente.php" method="POST">
                    <p><label>Sei sicuro di voler annullare la prenotazione?
                    <input type="hidden" name="nome_da_eliminare" id="input-nascosto-elimina" value=""/></label></p>
                    <button type="submit" id="conferma-annulla" name="conferma-annulla">SI</button>
                    <button type="button" id="revoca-annulla" name="revoca-annulla">NO</button>
                </form>
            </dialog>
        </tbody>
    </table>

    <h3 class="title-table">RICHIESTE IN CORSO</h3>
    <table class="table-prenotazioni-studente">
        <thead>
            <tr>
                <th id="numero-aula-lab">AULA / LAB</th>
                <th id="data-prenotazione">DATA</th>
                <th id="ora-prenotazione">ORARIO</th>
                <th id="sezione-annulla"></th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($templateParams["richieste_in_corso"])): ?>
                <?php if($templateParams["richieste_utente"] == 0): ?>
                    <tr>
                        <td colspan="4">Nessuna richiesta in programma.</td>
                    </tr>
                <?php endif; ?>  
            <?php else:
                foreach($templateParams["richieste_in_corso"] as $richiesta):
                $dataFormattata = date("d/m/Y", strtotime($richiesta["data"])); ?>
                <tr>
                    <td headers="numero-aula-lab"><?php echo $richiesta["num"]; ?></td>
                    <td headers="data-prenotazione"><?php echo $dataFormattata; ?></td>
                    <td headers="ora-prenotazione"><?php $oraInizio = date("H:i", strtotime($richiesta["oraInizio"])); echo $oraInizio; ?> - 
                    <?php $date = new DateTime($richiesta["oraInizio"]);
                        $date->modify("+{$richiesta["durata"]} minutes");
                        $oraFine = $date->format('H:i'); 
                        echo $oraFine;
                    ?></td>
                    <td headers="sezione-annulla">
                        <button class="button-elimina-evento" data-id="<?php echo $richiesta["codiceRichiesta"]; ?>">ELIMINA</button>
                        <?php if($templateParams["azione"] == 1 && $richiesta["codiceRichiesta"] == $templateParams["id"]): ?>
                            <a href="prenotazioni_studente.php" class="button-modifica-evento">ANNULLA</a>
                        <?php else: ?>
                            <a href="prenotazioni_studente.php?action=1&id=<?php echo $richiesta["codiceRichiesta"]; ?>" class="button-modifica-evento"> MODIFICA</a>
                        <?php endif; ?>
                        </a>
                    </td>
                </tr>
                <?php endforeach;
            endif; ?>
            <dialog id="finestra-elimina">
                <h4>ELIMINAZIONE RICHIESTA</h4>
                <form id="form-elimina-richiesta" action="prenotazioni_studente.php" method="POST">
                    <p><label>Sei sicuro di voler eliminare la richiesta?
                    <input type="hidden" name="richiesta_da_eliminare" id="input-nascosto-elimina-richiesta" value=""/></label></p>
                    <button type="submit" id="conferma-elimina" name="conferma-elimina">SI</button>
                    <button type="button" id="revoca-elimina" name="revoca-elimina">NO</button>
                </form>
            </dialog>
        </tbody>
    </table>
</div>
<script src="script/listaPrenotazioni_studente_script.js"
type="text/javascript"></script>