<html>
<head>
    <title>Sport Academie - Se connecter</title>
    <link rel="shortcut icon" href="./views/assets/logo.jpg" type="image/x-icon">
    <style>
        <?php
        echo file_get_contents('./views/assets/main.css');
        ?>
    </style>
</head>

<body>
    <div class="login">
        <h1>Se connecter</h1>
        <form method="post">
            <input type="email" name="email" placeholder="Email" required="required" />
            <input type="password" name="password" placeholder="Mot de passe" required="required" />
            <div class="remember-me">

              <div class="forgot-password">
              <a href="#">Mot de passe oublié?</a>
              </div>
              </div>
            
            <button type="submit" class="btn btn-primary btn-large">Se connecter</button>
        </form>
        <div class="suii">
            <p>Je n'ai aucun compte<a href="register.php"> Créer un compte</a></p>
        </div>
    </div>
</body>
</html>
