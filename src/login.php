<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    <title>Login Aule - Accesso</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php">
                <img src="upload/uniboLogo.png" alt="Logo Alma Aule">
            </a>
        </div>
        <div class="title">
            <h1>Alma Aule</h1>
        </div>
        <div class="login">
            <nav>
                <a href="login.php">Login</a>
            </nav>
        </div>
    </header>
    
    <main>
    <!-- foto -->
    </main>

    <div class="login-form">
        <form action="#" method="POST">
            <h2>ACCEDI</h2>
            <?php if(isset($templateParams["errorelogin"])): ?>
            <p><?php echo $templateParams["errorelogin"]; ?></p>
            <?php endif; ?>
            <ul>
                <li>
                    <label for="username">E-mail</label>
                    <input type="text" id="email" name="email" />
                </li>
                <li>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" />
                </li>
                <li>
                    <input type="submit" name="submit" class="conferma-login" value="CONFERMA" />
                </li>
            </ul>
        </form>
    </div>

    <footer>
        <p>Contatti</p>
    </footer>
</body>