<?php
/**
* File json_test.php
* Simple file for testing the consumption of json in PHP
* @author Kristal Dale
*/

define('SEC_MENSA',true);


/*
 * All includes go here
 */
$include_dir = __dir__ . '/../mensa_php/';
include $include_dir  . 'util/Util.php';
include $include_dir  . 'util/RenderHelper.php';
//TODO more includes? Login, Database,..??
include $include_dir  . 'abstracts/Renderable.php';
include $include_dir  . 'core/MSystem.php';



/**
 * Use json_decode to get an array built from the JSON string
 */
header('Content-type: text/html; charset=utf-8');

$mensaUrl = 'http://www.uni-ulm.de/mensaplan/data/mensaplan.json';
$jsonObj = UTIL::getJSON($mensaUrl);

echo RenderHelper::renderSummary($jsonObj);








