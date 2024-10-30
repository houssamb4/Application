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

<div class="login">
    <h1>Register</h1>
    <form method="post">
        <input type="text" name="first_name" placeholder="First Name" required="required" />
        <input type="text" name="last_name" placeholder="Last Name" required="required" />
        <input type="email" name="email" placeholder="Email" required="required" />
        <input type="text" name="role" placeholder="Role" required="required" />
        <input type="password" name="password" placeholder="Password" required="required" />
        <input type="password" name="confirm_password" placeholder="Confirm Password" required="required" />
        <button type="submit"  class="btn btn-primary btn-block btn-large">Creer un compte</button>
    </form>
    <div class="suii">
        <p>J'ai un compte existant <a href="index.php">Se connecter</a></p>
    </div>
</div>

</body>

</html>
