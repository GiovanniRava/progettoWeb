<figure>
    <img src="upload/giardinoCampus.jpeg" alt="giardino Campus di Cesena, foto sfondo Home page" class="home-img-login">
</figure>
<div class="login-form">
    <form action="login.php" method="POST" class="login-form-form">
        <h2>ACCEDI</h2>
        <ul>
            <li>
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" />
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" />
            </li>
            <li>
                <?php if(isset($templateParams["errore"])): ?>
                <p class="error-message"><?php echo $templateParams["errore"]; ?></p>
                <?php endif; ?>
            </li>
            <li>
                <input type="submit" name="submit" class="conferma-login" value="CONFERMA" />
            </li>
        </ul>
    </form>
</div>