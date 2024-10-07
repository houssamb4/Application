<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport Academie - Creer un compte</title>
    <link rel="shortcut icon" href="./views/assets/logo.jpg" type="image/x-icon">
    
    <style>
        <?php echo file_get_contents('./views/assets/main.css'); ?>
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
        
        <!-- Mot de passe avec option pour le montrer/masquer -->
        <div style="position: relative;">
            <input type="password" id="password" name="password" placeholder="Password" required="required" style="width: 100%; padding-right: 40px;" />
            <span id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-80%); cursor: pointer;">
            👁
                <i class="fas fa-eye"></i>
            </span>
        </div>

        <!-- Confirmation du mot de passe avec la même option -->
        <div style="position: relative;">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required="required" style="width: 100%; padding-right: 40px;" />
            <span id="toggleConfirmPassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-80%); cursor: pointer;">
            👁
                <i class="fas fa-eye"></i>
            </span>
        </div>

        <button type="submit" class="btn btn-primary btn-block btn-large">Creer un compte</button>
    </form>
    
    <div class="suii">
        <p>J'ai un compte existant <a href="index.php">Se connecter</a></p>
    </div>
</div>

<!-- JavaScript -->
<script>
    // Sélectionne les champs de mot de passe et les icônes
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const togglePassword = document.getElementById('togglePassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');

    // Pour le champ mot de passe
    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    // Pour le champ de confirmation du mot de passe
    toggleConfirmPassword.addEventListener('click', function () {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>


</body>

</html>
