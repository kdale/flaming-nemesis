<?php
/**
* File day.php
* Date and location specific detail page for the Mensa Plan
* @author Kristal Dale <kristal.dale@uni-ulm.de>
*/
defined('SEC_MENSA') or die('Restricted access');

header('Content-type: text/html; charset=utf-8');

class Page implements Renderable{
    public function getTitle(){
        return $_GET['loc'] . ' plan for ' . $_GET['date'];
    }
    public function writeContent(){
        $mensaUrl = 'http://www.uni-ulm.de/mensaplan/data/mensaplan.json';
        $jsonObj = UTIL::getJSON($mensaUrl);

        // clicking a link on the summary(week) page selects a specific day for a specific location. 
        echo RenderHelper::renderLocDay($jsonObj);
    }
}


