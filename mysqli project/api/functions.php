<?php

 /* connect to database  */
  function connectToDB()
  {
    $db = mysqli_connect("localhost", "root", "fall2015", "testDB");
    return $db;
  }//eom

/* check sign in 

  returns
    1   successfully logged in
    0   database is not responding
    -1  not a valid user
    -2  account locked
*/
function LogInUser($userData)
{
    //attempt to connect to DB
    $dbConnection = connectToDB();
    if(!$dbConnection)
    {
       echo "Unable to connect to MySQL.".PHP_EOL;
      return 0;
    }

    $emailOrUsername  = $userData['username1'];
    $password         = $userData['password1'];

  
      //preparing the mysql query for the user account lookup
      $query      = "SELECT password, email, loginRequest, accountLocked
                     FROM `users` 
                     WHERE username ='".$emailOrUsername."' or email='".$emailOrUsername."'";

      //querying database
      $result     = mysqli_query($dbConnection, $query);
      $row        = mysqli_fetch_array( $result, MYSQLI_ASSOC );
      $rowResult  = array_filter($row);

      //check if no user exist with credentials provided
      if( empty($row) )
      {
        return -1;
      }


      //check if account is locked
      $accountLocked = $row['accountLocked'];
      if($accountLocked)
      {
        return -2;
      }

      //check if password provided is Valid
      
        //cleaning provided password
        $cleanpass        = mysqli_real_escape_string($dbConnection, $password);
        $DB_Password      = $row['password'];
        $passwordResults  = password_verify($cleanpass, $DB_Password);
        if($passwordResults) 
        {
          // echo 'Password is valid!';
          return 1;
        } 

      // echo "invalid password";
      return -1;

}//eom


/* 
  registers a user into the database

  returns
    1   successfully registered user
    0   database not responding
    -1  credentials not unique (username/email is already taken)
    -2  un-able to register user
*/
function registerUser($userData)
{
    //attempt to connect to DB
    $dbConnection = connectToDB();
    if(!$dbConnection)
    {
      echo "Unable to connect to MySQL.".PHP_EOL;
      return 0;
    }

    $username       = $userData['username'];
    $password       = $userData['password'];

    //cleaning password
    $cleanPassword  = mysqli_real_escape_string($dbConnection, $password);

      //hashing password
      $options= array('cost' => 10);
      $passwordHashed = password_hash($cleanPassword, PASSWORD_BCRYPT, $options);

    $first_name     = $userData['fname'];
    $last_name      = $userData['lname'];
    $email          = $userData['email'];
    $active         = 1;
    $passreset      = 0;
    $code           = 0;
    $confirmed      = 0;
    $confirmcode    = 0;
    $loginRequest   = 0;
    $accountLocked  = 0;

    //check if user is uniquer
    $uniqueResult = checkUniqueCredentials($dbConnection, $username, $email);
    if($uniqueResult == false)
    {
      return -1;
    }
    
    //register user onto DB
    $statement = "'".$username."','".$passwordHashed."','".$first_name."','".$last_name."','".$email."','".$active."','".$passreset."','".$code."','".$confirmed."','".$confirmcode."','".$loginRequest."','".$accountLocked."'";
    
    $query = "INSERT INTO `users`(`username`, `password`, `first_name`, `last_name`, `email`, `active`, `passreset`, `code`, `confirmed`, `confirmcode`, `loginRequest`, `accountLocked`) 
              VALUES (".$statement.")";

    //querying database
    $result  = mysqli_query($dbConnection, $query);
    if($result)
    {
      //successfully registered user
      return 1;
    }

    //un-able to register user
    return -2;
}//eom



/* */
function checkUniqueCredentials($dbConnection, $username, $email)
{
    // making sure user is a unique registration
    $query      = "SELECT *  
                   FROM `users`
                   WHERE `email`='".$email."' or `username`= '".$username."'";

    $result     = mysqli_query($dbConnection, $query); 
    $row        = mysqli_fetch_array( $result, MYSQLI_ASSOC );
    $rowResult  = array_filter($row);
    if($rowResult)
    {
      // echo "<p>user is not unique!</p>";
      // print_r($rowResult);
      return false;  //NOT unique user
    }

     // echo "<p>user is unique!</p>";
    return true;  //unique user
}//eom




?>