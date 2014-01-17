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
        <link rel="stylesheet" type="text/css" href="/css/style.css" />
        <link rel="stylesheet" type="text/css" media="print" href="/css/print.css" />
    </head>
    <body>
        <div class="container">
        <header role="banner">
            <hgroup>
                <h1><a href="/" class="mensa">Mensa</a></h1>
                <h2>Nourishing brains at Uni Ulm since 1967</h2>
                <p class="sw_logo">Part of Studentenwerk Ulm</p>
            </hgroup>
            <nav>
                <ul>
                    <li><a href="' .$base . 'welcome">Home</a></li>
                    <li><a href="' .$base . 'about">About</a></li>
                </ul>
            </nav>
            <section class="login">
                <form name="login" action="login" method="get" accept-charset="utf-8">
                    <input type="text" name="username" placeholder="username" required>
                    <input type="password" name="password" placeholder="password" required>
                    <input type="submit" value="Login">
                </form>
            </section>
        </header>
        ';