<!DOCTYPE html>
<html>
<head>
    <title>Account Created Successfully</title>
    <link rel="shortcut icon" href="./assets/logo.jpg" type="image/x-icon">
    <style>
        <?php echo file_get_contents('./main.css'); ?>
        /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.login {
    background-color: white;
    padding: 40px 60px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    text-align: center;
    width: 100%;
    max-width: 400px;
}

h1 {
    color: #2ecc71;
    font-size: 26px;
    margin-bottom: 20px;
}

p {
    font-size: 16px;
    color: #555;
    margin-bottom: 30px;
}

a {
    color: #3498db;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    color: #2980b9;
}

.login a {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 20px;
    background-color: #3498db;
    color: white;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.login a:hover {
    background-color: #2980b9;
}

/* Mobile Responsive */
@media (max-width: 480px) {
    .login {
        padding: 20px;
        width: 90%;
    }
}

    </style>
</head>
<body>
    <div class="login">
        <h1>Account Created Successfully!</h1>
        <p>Your account has been created successfully. <a href="../index.php">Click here to login</a>.</p>
    </div>
</body>
</html>
