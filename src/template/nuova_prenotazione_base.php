<div class="form-prenotazione">
    <form action="prenotazioni_studente.php?action=<?php echo $templateParams["azione"] ?? 0; ?>&id=<?php echo $templateParams["id"] ?? ""; ?>" method="POST" class="form-form-prenotazione">
    <fieldset>
    <ul>
            <li><div class="col-title">
                <?php if(isset($templateParams["form"])):
                    echo $templateParams["form"];
                else: ?>
                    RICHIESTA NUOVA PRENOTAZIONE
                <?php endif; ?>
            </div></li>
            <li>
                <div class="col">
                    <label for="aula-lab">Scegli Aula o Lab</label>
                    <select class="input-medio" name="aula-lab" id="aula-lab">
                        <option value="<?php if(isset($templateParams["aula"])): echo $templateParams["aula"]; endif;?>" hidden selected>
                            <?php if(isset($templateParams["aula"])): echo $templateParams["aula"]; endif;?>
                        </option>
                        <?php foreach($templateParams["aule"] as $aula): ?>
                        <option value="<?php echo $aula["numeroAula"] ?>"><?php echo $aula["numeroAula"] ?></option>
                        <?php endforeach; ?>
                        <?php foreach($templateParams["lab"] as $lab): ?>
                        <option value="<?php echo $lab["numeroLab"] ?>"><?php echo $lab["numeroLab"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col">
                    <label for="data">Data</label>
                    <input type="date" class="input-medio" id="data" name="data"
                    value="<?php if(isset($templateParams["data"])): echo $templateParams["data"]; endif;?>"/>
                </div>
            </li>
            <li>
                <div class="col">
                    <label for="ora">Orario inizio:</label>
                    <select class="input-medio" name="oraInizio" id="ora">
                        <option value="<?php if(isset($templateParams["oraInizio"])): echo $templateParams["oraInizio"]; endif;?>" hidden selected>
                            <?php if(isset($templateParams["oraInizio"])): echo $templateParams["oraInizio"]; endif;?>
                        </option>
                        <option value="09:00">09:00</option>
                        <option value="09:30">09:30</option>
                        <option value="10:00">10:00</option>
                        <option value="10:30">10:30</option>
                        <option value="11:00">11:00</option>
                        <option value="11:30">11:30</option>
                        <option value="12:00">12:00</option>
                        <option value="12:30">12:30</option>
                        <option value="13:00">13:00</option>
                        <option value="13:30">13:30</option>
                        <option value="14:00">14:00</option>
                        <option value="14:30">14:30</option>
                        <option value="15:00">15:00</option>
                        <option value="15:30">15:30</option>
                        <option value="16:00">16:00</option>
                        <option value="16:30">16:30</option>
                        <option value="17:00">17:00</option>
                        <option value="17:30">17:30</option>
                        <option value="18:00">18:00</option>
                    </select>
                </div>
                <div class="col">
                <label for="durata">Durata</label>
                    <select class="input-medio" name="durataPermanenza" id="durata">
                        <option value="<?php if(isset($templateParams["durata"])): echo $templateParams["durata"]; endif;?>" hidden selected>
                            <?php if(isset($templateParams["durata"])): echo $templateParams["durata"]; endif;?>
                        </option>
                        <option value="00:30">00:30</option>
                        <option value="01:00">01:00</option>
                        <option value="01:30">01:30</option>
                        <option value="02:00">02:00</option>
                        <option value="02:30">02:30</option>
                        <option value="03:00">03:00</option>
                    </select>
                </div>
            </li>
            <li>
                <div class="col">
                    <label for="nominativo">Nome e Cognome</label>
                    <input type="text" class="input-pieno" id="nominativo" name="nominativo"
                    value="<?php if(isset($templateParams["nominativo"])): echo $templateParams["nominativo"]; endif;?>"/>
                </div>
            </li>
            <li>
                <div class="col">
                    <label for="motivazione">Motivazione</label>
                    <textarea name="motivazionePrenotazione" id="motivazione" rows="7" placeholder="Scrivi..."><?php if(isset($templateParams["motivazione"])): echo htmlspecialchars($templateParams["motivazione"]); endif;?></textarea>
                </div>
            </li>
            <li>
                <?php if(isset($templateParams["errore"])): ?>
                <p class="error-message"><?php echo $templateParams["errore"]; ?></p>
                <?php endif; ?>
                <?php if(isset($successo)): ?>
                <p class="success-message"><?php echo $successo; ?></p>
                <?php endif; ?>
            </li>
            <li>
                <input type="submit" name="submit" class="button-nuova-prenotazione"
                value="<?php if(isset($templateParams["button"])): echo $templateParams["button"];
                else: ?> INVIA PRENOTAZIONE <?php endif; ?>" />
            </li>
        </ul>
        </fieldset>    
    </form>
</div>