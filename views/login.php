<style>
    
  <?php
  echo file_get_contents('./assets/main.css')
   ?>
</style>

<div class="login">
	<h1>Login</h1>
    <form method="post">
    	<input type="text" name="u" placeholder="Email" required="required" />
        <input type="password" name="p" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Sign in</button>
    </form>
    <div class="suii"><p>I don't have an account <a href="register.php">Sign Up</a></p></div>
</div>