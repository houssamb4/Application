<style>
    
  <?php
  echo file_get_contents('./assets/main.css')
   ?>
</style>

<div class="login">
	<h1>Register</h1>
    <form method="post">
        <input type="text" name="first_name" placeholder="First Name" required="required" />
    	<input type="text" name="last_name" placeholder="Last Name" required="required" />
        <input type="email" name="email" placeholder="Email" required="required" />
        <input type="text" name="role" placeholder="Role" required="required" />
        <input type="password" name="p" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Sign up</button>
    </form>
    <p>I already have an account </p><a href="login.php">Sign In</a>
</div>


