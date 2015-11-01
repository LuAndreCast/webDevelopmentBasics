<?php 

/* */
function hashPassword($passwordProvided)
{
  //hashing password
  $options= array('cost' => 10);
  $passwordHashed = password_hash($passwordProvided, PASSWORD_BCRYPT, $options);


    /*
      // if the password is being stored in database, make sure to clean the password with
      // the below method before saving to database

        $cleanPassword  = mysqli_real_escape_string($dbConnection, $passwordProvided);
    */



  //you can delete from this line
?>
  <br>
  <br>
  <h3>Hashing Password</h3>
  <p><b>hashed password:</b>
<?php
  echo $passwordHashed;
?>
  </p>
  <p>
<?php
  echo "hashed password has length of '".strlen($passwordHashed)."'";
?>
  </p>
<?php
    //gives you information about hash
  var_dump(password_get_info($passwordHashed));
?>
<br>
<br>
<?php
  //up to this line





  //saving hashed password in a text file , to be read later when unhashing
  $filename = 'hashedPassword.txt';
  file_put_contents($filename, var_export($passwordHashed, true));


  return $passwordHashed;
}//eom

/* */
function unhashPassword($passwordProvided)
{
    //getting hashed password from file
    $obtainHashPassword = file_get_contents('hashedPassword.txt');


    
    //if you are reading from a file, call the below method
      $subHashPassword = substr( $obtainHashPassword, 1, 60 );
    


    /*
      // if the password is being stored in database, make sure to clean the password with
      // the below method before saving to database

        $cleanPassword  = mysqli_real_escape_string($dbConnection, $passwordProvided);
    */



//you can delete from this line
?>
  <h3>Unhashing Password</h3>
  <p><b>hashed password:</b>
<?php
    echo $subHashPassword;
?>
  </p>
  <p>
<?php
    echo "hashed password has length of '".strlen($subHashPassword)."'";
?>
  </p>
<?php
// up to this line


    $results = password_verify($passwordProvided, $subHashPassword);
    if($results) 
    {
      echo 'Password is valid!';
      return true;
    } 

    echo "invalid password";
    return false;
}//eom


?>