<?php
/**
* File index.php
* Thist is the template file, every page-request will end up
* @author Philipp Hock <philipp.hock@uni-ulm.de>
*/



/**
 * Every framefork file must contain this line at the beginning for security reason
 */
define('SEC_MENSA',true);


/*
 * All includes go here
 */
$include_dir = __dir__ . '/../mensa_php/';
include $include_dir  . 'util/Util.php';
//TODO more includes? Login, Database,..??
include $include_dir  . 'abstracts/Renderable.php';
include $include_dir  . 'core/MSystem.php';


/*
 * Bootup the system
 */
$system = new MSystem($include_dir,"mensaplan");
$system->start();




