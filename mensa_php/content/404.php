<?php
/**
* File 404.php
* Default content not found page
* @author Kristal Dale <kristal.dale@uni-ulm.de>
*/
defined('SEC_MENSA') or die('Restricted access');

header('Content-type: text/html; charset=utf-8');

class Page implements Renderable{
    public function getTitle(){
        return "404: File not found";
    }
    public function writeContent(){
        echo '<article class="day"><h1>Oops!</h1><p> The page you requested doesn not exist (maybe never did!) - please check the main <a href="/">Mensa plan</a> for the current information.</p></article>';
    }
}


