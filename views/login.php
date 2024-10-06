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
        <input type="password" name="password" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Se connecter</button>
    </form>
    <div class="suii"><p>Je n'ai aucun compte<a href="register.php">Creer un compte</a></p></div>
</div>