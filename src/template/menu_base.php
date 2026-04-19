<nav class="menu-navigazione">
    <ul>
        <?php foreach ($templateParams["voci_menu"] as $voce): ?>
            <li>
                <a href="<?php echo $voce['url']; ?>">
                    <?php echo htmlspecialchars($voce['nome']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

<div class="sezione-logout">
    <a href="logout.php" class="btn-logout">LOGOUT</a>
</div>