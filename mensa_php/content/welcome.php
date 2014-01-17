<?php
/**
* File welcome.php
* A simple welcome page to test the framework
* @author Philipp Hock <philipp.hock@uni-ulm.de>
*/
defined('SEC_MENSA') or die('Restricted access');
class Page implements Renderable{
    public function getTitle(){
        return "Welcome";
    }
    public function writeContent(){
        echo "<p>welcome to mensaplan!</p>";
    }
}


