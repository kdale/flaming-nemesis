<?php
/**
* File Util.php
* Contains static utility functions
* @author Philipp Hock <philipp.hock@uni-ulm.de>
*/

class Util{
    /**
     * simple endsWith function
     * usage: Util::endsWith('abcd','cd') //will return True
     * @param string $haystack the string to search
     * @param string $needle the end to check
     * @return bool true if $haystack ends with $needle, otherwise returns false 
     */
    public static function endsWith($haystack, $needle){
        return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
    }
    
    /**
     * 
     * @param type $append appends the given string to the return value
     * @return string the fqdn (+ $append) of this server, 
     * also checks for http/https 
     */
    public static function url($append=""){
        return sprintf(
          "%s://%s/%s/",
          isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
          $_SERVER['HTTP_HOST'],$append
        );
    }
    
    /**
     * 
     * @param string $jsonUrl
     * @return object of the decoded JSON content 
     */
    public static function getJSON($jsonUrl){
        $json = file_get_contents($jsonUrl);
        
        if($json !== false) { // file_get_contents will return false on failure
            return json_decode($json); 
        }
        else {
            return null; // json_decode will also return null on failur
        }
    }
}