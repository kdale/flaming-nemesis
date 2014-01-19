<?php
/**
* File welcome.php
* Welcome page for Mensa site, shows week view for each Mensa location
* @author Kristal Dale <kristal.dale@uni-ulm.de>
*/
defined('SEC_MENSA') or die('Restricted access');

header('Content-type: text/html; charset=utf-8');

class Page implements Renderable{
    public function getTitle(){
        return "Welcome";
    }
    public function writeContent(){
        $mensaUrl = 'http://www.uni-ulm.de/mensaplan/data/mensaplan.json';
        $jsonObj = UTIL::getJSON($mensaUrl);

        if ($jsonObj != null) {
            echo RenderHelper::renderSummary($jsonObj);
        }
        else {
            echo '<article><h1>Oops!</h1> <p>Something went wrong - please be patient. We are working to fix it as fast as we can!</p></h1>';
        }
        
    }
}


