<?php
class Download 
{
    const URL_MAX_LENGTH = 2050;

    //clean url
    protected function cleanUrl($url) 
    {
        if ($url) 
        {
            if (!empty($url)) 
            {
                if (strlen($url) < self::URL_MAX_LENGTH) 
                {
                    return strip_tags($url);
                }
            }   
        }
    }//eom

    //is url
    protected function isURL($url) 
    {
        $url = $this->cleanUrl($url);
        if ($url) 
        {
            if (filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)) 
            {
                return $url;    
            }
        }
    }//eom

    //return extension
    protected function returnExtension($url) 
    {
        if ($this->isURL($url)) 
        {
            $end = end(preg_split("/[.]+/", $url));
            if ($end) 
            {
                return $end;
            }
        }           
    }//eom

    //download file
    public function downloadFile($url) 
    {
        $extension = $this->returnExtension($url);
        if ($extension) 
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $return = curl_exec($ch);
            curl_close($ch);

            $destination = "downloads/file.$extension";
            $file = fopen($destination, "w+");
            fputs($file, $return);
            if (fclose($file)) 
            {
                echo "File downloaded";
            }
        }
    }//eom

}//eoc

?>