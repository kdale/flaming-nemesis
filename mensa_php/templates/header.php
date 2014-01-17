<?php
/**
* File header.php
* prints the html header
* 
* here you can acces the current page via $page
* @author Philipp Hock <philipp.hock@uni-ulm.de>
*/
defined('SEC_MENSA') or die('Restricted access');
if (isset($page)){
    $title = $page->getTitle();
}else{
    $title = "Mensaplan";
}

$base=MSystem::getBaseURL();

echo '
<!DOCTYPE html>
<html>
    <head>',
        "<title>$title</title>",
        '<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
<nav>
<ul>
    <li><a href="' .$base .  '?page=welcome">home</a></li>
    <li><a href="' .$base .  '?page=about">about</a></li>    
</ul>
</nav>
';
    

