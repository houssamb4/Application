<html>
<head>
<title>Sport Academie - Sign Up</title>
<link rel="shortcut icon" href="./views/assets/logo.jpg" type="image/x-icon">
<style>
    
  <?php
  echo file_get_contents('./views/assets/main.css')
   ?>
</style>
</head>

<div class="login">
	<h1>Login</h1>
    <form method="post">
    	<input type="email" name="email" placeholder="Email" required="required" />
        <input type="password" name="password" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Sign in</button>
    </form>
    <div class="suii"><p>I don't have an account<a href="register.php">Sign Up</a></p></div>
</div>