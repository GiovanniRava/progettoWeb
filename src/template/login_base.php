<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login Aule - Accesso</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php">
                <figure>
                    <img src="upload/uniboLogo.png" alt="Logo Alma Aule">
                </figure>
            </a>
        </div>
        <div class="title">
            <h1>Alma Aule</h1>
        </div>
        <div class="login">
            <a href="login.php">Login</a>
        </div>
    </header>
    
    <main class="main-home">
        <figure>
            <img src="upload/giardinoCampus.jpeg" alt="giardino Campus di Cesena, foto sfondo Home page" class="home-img-login">
        </figure>
        <div class="login-form">
            <form action="login.php" method="POST" class="login-form-form">
                <h2>ACCEDI</h2>
                <?php if(isset($errore)): ?>
                <p class="error-message"><?php echo $errore; ?></p>
                <?php endif; ?>
                <ul>
                    <li>
                        <label for="email">E-mail</label>
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
    </main>
    <?php require($templateParams["footer"]); ?>
</body>