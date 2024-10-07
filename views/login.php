<html>
<head>
<title>Sport Academie - Creer un compte</title>
<link rel="shortcut icon" href="./views/assets/logo.jpg" type="image/x-icon">
<style>
    
  <?php
  echo file_get_contents('./views/assets/main.css')
   ?>
</style>
</head>

<div class="login">
    <h1>Se connecter</h1>
    <form method="post">
        <input type="email" name="email" placeholder="Email" required="required" />

        <!-- Champ de mot de passe avec icône pour afficher/masquer -->
        <div style="position: relative;">
            <input type="password" id="password" name="password" placeholder="Password" required="required" style="width: 100%; padding-right: 40px;" />
            <!-- Bouton pour afficher/masquer le mot de passe -->
            <span id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-80%); cursor: pointer;">
                👁
            </span>
        </div>

        <button type="submit" class="btn btn-primary btn-block btn-large">Se connecter</button>
    </form>
    <div class="suii">
        <p>Je n'ai aucun compte <a href="register.php">Créer un compte</a></p>
    </div>
</div>

<script>
    // Sélectionne le champ de mot de passe et l'icône
    const passwordInput = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');

    // Ajoute un événement au clic sur l'icône
    togglePassword.addEventListener('click', function () {
        // Vérifie le type actuel de l'input
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Change l'icône en fonction de l'état (mot de passe caché ou visible)
        this.textContent = type === 'password' ? '👁' : '🙈';
    });
</script>
