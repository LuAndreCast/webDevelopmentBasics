<html>
<head>
    <title>Download a file by providing the URL</title>
</head>
<body>
    <p>Download a file by providing the URL</p>
    <br>
    <form action="index.php" method="post">
        <input type="text" name="url" maxlength="2000"/>
        <input type="submit" value="Download"/>
    </form>
</body>
</html>


<?php

/*
    
    http://2.bp.blogspot.com/_gfXupHOEhH0/S_Z6E5MrHFI/AAAAAAAARQE/BPIXQghOsdM/s1600/Star-Wars-Wallpaper-3.jpg

*/

    if (isset($_POST['url'])) 
    {
        require "downloadClass.php";

        $obj = new Download();
        $obj->downloadFile($_POST['url']);
    }

?>