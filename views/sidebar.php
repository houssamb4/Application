<?php
require_once('../db.php'); 
require_once('../classes/login.php'); 

$login = new Login($conn);

if (!$login->isLoggedIn()) {
    header("Location: ../index.php");  
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tableau de board - Sport Academie</title>
    <link rel="shortcut icon" href="./assets/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>


<style>
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");
    .navbar-global {
  background-color: indigo;
}

.navbar-global .navbar-brand {
  color: white;
}

.navbar-global .navbar-user > li > a
{
  color: white;
}

.navbar-primary {
  background-color: #333;
  bottom: 0px;
  left: 0px;
  position: absolute;
  top: 51px;
  width: 200px;
  z-index: 8;
  overflow: hidden;
  -webkit-transition: all 0.1s ease-in-out;
  -moz-transition: all 0.1s ease-in-out;
  transition: all 0.1s ease-in-out;
}

.navbar-primary.collapsed {
  width: 60px;
}

.navbar-primary.collapsed .glyphicon {
  font-size: 22px;
}

.navbar-primary.collapsed .nav-label {
  display: none;

}

.nav-label{
    margin-left: 10px;
}

.btn-expand-collapse {
    position: absolute;
    display: block;
    left: 0px;
    bottom:0;
    width: 100%;
    padding: 8px 0;
    border-top:solid 1px #666;
    color: grey;
    font-size: 20px;
    text-align: center;
}

.btn-expand-collapse:hover,
.btn-expand-collapse:focus {
    background-color: #222;
    color: white;
}

.btn-expand-collapse:active {
    background-color: #111;
}

.navbar-primary-menu,
.navbar-primary-menu li {
  margin:0; padding:0;
  list-style: none;
}

.navbar-primary-menu li a {
  display: block;
  padding: 10px 18px;
  text-align: left;
  border-bottom:solid 1px #444;
  color: #ccc;
}

.navbar-primary-menu li a:hover {
  background-color: #000;
  text-decoration: none;
  color: white;
}

.navbar-primary-menu li a .glyphicon {
  margin-right: 6px;
}

.navbar-primary-menu li a:hover .glyphicon {
  color: orchid;
}

.main-content {
  margin-top: 60px;
  margin-left: 200px;
  padding: 20px;
}

.collapsed + .main-content {
  margin-left: 60px;
}

.logonav{
    display: flex;
    align-items: center;
    justify-content: center;
}

.logonav a{
    font-size: 18px;
    font-weight: 700;
    font-family: ;
}

.logo{
    width: 30px;
    display: flex;
    margin-right: 7px;
}

.navbar-primary-menu {
    list-style-type: none;
    padding: 0;
    margin: 0;
    width: 250px;
    background-color: #333;
}

.navbar-primary-menu li {
    position: relative;
}

.navbar-primary-menu a {
    display: block;
    padding: 10px;
    text-decoration: none;
    color: white;
    font-size: 16px;
    transition: background-color 0.3s;
}

.navbar-primary-menu a:hover {
    background-color: #575757;
}

.dropdown-btn {
    cursor: pointer;
}

.dropdown-container {
    display: none;
    list-style: none;
    padding: 0;
    margin: 0;
}

.dropdown-container li {
    background-color: #444;
}

.dropdown-container a {
    padding-left: 20px;
}

.dropdown-container a:hover {
    background-color: #575757;
}

.show {
    display: block;
}


</style>
<nav class="navbar navbar-inverse navbar-global navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="logonav">
        <img class="logo" src="../views/assets/logo.jpg" alt="logo">
        <a class="navbar-brand" href="./home.php">Sport Académie </a> 
      </div></div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-user navbar-right">
          <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['first_name']; echo ' '; echo $_SESSION['last_name']; ?></a></li>
          <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Se déconnecter</a></li>
        </ul>
      </div>
    </div>
  </nav>
<nav class="navbar-primary">
<a href="#" class="btn-expand-collapse"><span class="glyphicon glyphicon-menu-left"></span></a>
<ul class="navbar-primary-menu">
  <li>
    <a href="./home.php"><span class="bi bi-house-door-fill"></span><span class="nav-label">Accueil</span></a>
    <a href="./list_users.php"><span class="bi bi-people-fill"></span><span class="nav-label">Utilisateurs</span></a>
    <a href="#" class="dropdown-btn"><span class="bi bi-person-fill"></span><span class="nav-label">Clients</span></a>
    <ul class="dropdown-container">
      <li><a href="./create_client.php">Créer Client</a></li>
      <li><a href="./edit_client.php">Modifier Client</a></li>
      <li><a href="./list_clients.php">Lister Clients</a></li>
      <li><a href="./supprimer_client.php">Supprimer Clients</a></li>
    </ul>

    <a href="#" class="dropdown-btn"><span class="bi bi-file-earmark-fill"></span><span class="nav-label">Abonnements</span></a>
    <ul class="dropdown-container">
      <li><a href="./create_abonnement.php">Créer Abonnement</a></li>
      <li><a href="./list_abonnements.php">Lister Abonnements</a></li>
    </ul>

    <a href="#" class="dropdown-btn"><span class="bi bi-cash-coin"></span><span class="nav-label">Recettes</span></a>
    <ul class="dropdown-container">
      <li><a href="./create_recette.php">Créer Recette</a></li>
      <li><a href="./list_recettes.php">Lister Recettes</a></li>
    </ul>

    <a href="#" class="dropdown-btn"><span class="bi bi-folder-fill"></span><span class="nav-label">Catégories</span></a>
    <ul class="dropdown-container">
      <li><a href="./create_categorie.php">Créer Catégorie</a></li>
      <li><a href="./list_categories.php">Lister Catégories</a></li>
    </ul>

    <a href="#"><span class="bi bi-person-fill"></span><span class="nav-label">Profile</span></a>
    <a href="#"><span class="bi bi-gear-fill"></span><span class="nav-label">Paramètres</span></a>
    <a href="#"><span class="bi bi-bell-fill"></span><span class="nav-label">Notifications</span></a>
    <a href="#"><span class="bi bi-display-fill"></span><span class="nav-label">Moniteur</span></a>
  </li>
</ul>
</nav>

<script>
    $('.btn-expand-collapse').click(function(e) {
	$('.navbar-primary').toggleClass('collapsed');
    });

    document.querySelectorAll('.dropdown-btn').forEach(button => {
        button.addEventListener('click', function () {
            const dropdownContent = this.nextElementSibling;
            dropdownContent.classList.toggle('show');
        });
    });
</script>