<html>
  <head>
    <link rel="stylesheet" href="myCSS.css" type="text/css">
    <title>File Upload</title>
  </head>
  <body>
    <div class="fileuploadholder">
      <form action="" method="POST" enctype="multipart/form-data" name="FileUploadForm" id="FileUploadForm">
        <label for="UploadFile"></label>
        <input type="file" name="UploadFile" id="UploadFile"></input>
        <input type="submit" name="UploadButton" id="UploadButton" value="Upload"></input>
      </form>
    </div>
  </body>
</html>

<?php 

require 'upload.php';

uploadFile();

?>