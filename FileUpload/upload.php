<?php

function uploadFile()
{
  if( isset($_FILES['UploadFile']) )
  {
    $UploadName = $_FILES['UploadFile']['name'];
    $UploadName = mt_rand(100000,999999).$UploadName;
    $UploadTmp  = $_FILES['UploadFile']['tmp_name'];
    $UploadType = $_FILES['UploadFile']['type'];
    $FileSize   = $_FILES['UploadFile']['size'];

    //cleaning spaces and characters
    $UploadName = preg_replace("#[^a-z0-9.]#i", "", $UploadName);

    //Upload File Size Limit
    if($FileSize > 525000)
    {
      die("Error - File to Big");
    }

    //Checks a File has been Selected and Uploads them into Directory
    if( !$UploadTmp )
    {
      die("No File Selected, Please Upload Again");
    }
    else
    {
      $directory = "Upload/$UploadName";
      move_uploaded_file($UploadTmp, $directory);
    }
  }
}//eom

?>