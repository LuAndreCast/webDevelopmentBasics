<html>
<head>
  <title>Hashing and UnHashing</title>
</head>
<body>
  <form action="" method="POST">
  <input type="text" name="username1" placeholder="username"></input><br>
  <input type="password" name="password1" placeholder="password"></input><br>
  <input type="submit" value="LogIn"></input>
  <br>
  <br>
    <input type="text" name="username" placeholder="username"></input><br>
    <input type="password" name="password" placeholder="password"></input><br>
    <input type="email" name="email" placeholder="email"></input><br>
    <input type="text" name="fname" placeholder="fname"></input><br>
    <input type="text" name="lname" placeholder="lname"></input><br><br>

    <input type="submit" value="register"></input>
  </form>
</body>
</html>

<?php
  require 'api/functions.php';


  // print_r($_POST);
  

  $data = $_POST;
  //checking login credentials
  
  $logInResults = LogInUser($data);
    switch ($logInResults) 
    {
      case 1:
        echo "Successfuly Logged in!";
        break;
      case 0:
        echo "Database not responding";
        break;

       case -1:
        echo "Incorrect credentials";
        break;

      case -2:
        echo "Account Locked";
        break;
      
      default:
        echo "<br>";
        break;
    }



  //registering user

  // $registerResults = registerUser($data);
  // switch ($registerResults) 
  // {
  //   case 1:
  //     echo "Successfuly Registered!";
  //     break;
  //   case 0:
  //     echo "Database not responding";
  //     break;

  //    case -1:
  //     echo "Un-able to register user, credentials already taken";
  //     break;

  //   case -2:
  //     echo "Un-able to register user";
  //     break;
    
  //   default:
  //     echo "<br>";
  //     break;
  // }

  
?>