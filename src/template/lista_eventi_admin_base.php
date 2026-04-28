<!--<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
    <title>Eventi - Alma Aule</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>-->
<body>
    <!--

    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>EVENTI</h2>
        </div>
        <div class="spacer"></div>
    </div>-->

    <main>
        <div class="table-container">
        <!-- <section class="table-aule"> -->
            <table class="table-eventi-admin">
                <thead>
                    <tr>
                        <th>TITOLO</th>
                        <th>AULA</th>
                        <th>DATA</th>
                        <th>ORARIO</th>
                        <th id="sezione-elimina"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($templateParams["eventi"])): ?>
                        <tr>
                            <td colspan="4" style="text-align: center;">Nessun evento in programma.</td>
                        </tr>
                    <?php else:
                        foreach($templateParams["eventi"] as $evento): ?>
                            <?php 
                                $luogo = !empty($evento['numeroAula']) ? $evento['numeroAula'] : 
                                         (!empty($evento['numeroLab']) ? $evento['numeroLab'] : '-');

                                $dataFormattata = date("d/m/Y", strtotime($evento['data']));
                                $oraFormattata = date("H:i", strtotime($evento['oraInizio']));
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($evento['titolo']); ?></td>
                                <td><?php echo htmlspecialchars($luogo); ?></td>
                                <td><?php echo $dataFormattata; ?></td>
                                <td><?php echo $oraFormattata; ?></td>
                                <td headers="sezione-elimina">
                                    <button class="button-elimina-evento" data-id="<?php echo $evento["titolo"]; ?>">ELIMINA</button>
                                    <?php if($templateParams["azione"] == 1 && $evento["titolo"] == $templateParams["id"]): ?>
                                        <a href="eventi_admin.php" class="button-modifica-evento">ANNULLA</a>
                                    <?php else: ?>
                                        <a href="eventi_admin.php?action=1&id=<?php echo $evento["titolo"]; ?>" class="button-modifica-evento"> MODIFICA</a>
                                    <?php endif; ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach;
                    endif; ?>
                    <dialog id="finestra-annulla">
                        <h3>ELIMINA EVENTO</h3>
                        <p>Sei sicuro di voler eliminare l'evento?</p>
                        <form id="form-elimina-evento" action="eventi_admin.php" method="POST">
                            <input type="hidden" name="nome_da_eliminare" id="input-nascosto-elimina" value="">
                            <button type="submit" id="conferma-elimina" name="conferma-elimina">SI</button>
                            <button type="button" id="revoca-elimina" name="revoca-elimina">NO</button>
                        </form>
                    </dialog>
                </tbody>
            </table>
        <!-- </section> -->
        </div>
    </main>
    <!--<php -->
    <script src="script/lista_eventi_admin_script.js"
    type="text/javascript"></script>
</body>
</html>