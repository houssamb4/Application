<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport Academie - Créer un compte</title>
    <link rel="shortcut icon" href="./views/assets/logo.jpg" type="image/x-icon">
    
    <style>
        <?php
        echo file_get_contents('./views/assets/main.css');
        ?>
    </style>
</head>

<body>

    <div class="register-container">
        <h1 class="register-title">Créer un compte</h1>
        <form method="post">
            <input type="text" name="first_name" placeholder="Prénom" class="form-input" required="required" />
            <input type="text" name="last_name" placeholder="Nom" class="form-input" required="required" />
            <input type="email" name="email" placeholder="Email" class="form-input" required="required" />
            <input type="text" name="role" placeholder="Rôle" class="form-input" required="required" />
            <input type="password" name="password" placeholder="Mot de passe" class="form-input" required="required" />
            <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" class="form-input" required="required" />
            <button type="submit" class="submit-btn">Créer un compte</button>
        </form>
        <div class="register-footer">
            <p>Vous avez déjà un compte ? <a href="index.php">Se connecter</a></p>
        </div>
    </div>

</body>

</html>
