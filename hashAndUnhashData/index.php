<html>
<head>
  <title>Hashing and UnHashing</title>
</head>
<body>
  <form action="" method="POST">
    <input type="text" name="username" placeholder="username"></input><br>
    <input type="password" name="password" placeholder="password"></input><br><br>
    <input type="submit" value="LogIn"></input>
  </form>
</body>
</html>

<?php
  require 'functions.php';

  $providedPassword = $_POST['password'];

  //hashing password
  hashPassword($providedPassword);

  //verify password
  unhashPassword($providedPassword);


?>