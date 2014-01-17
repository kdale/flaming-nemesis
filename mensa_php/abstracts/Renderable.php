<?php
/**
* File Renderable.php
* @author Philipp Hock <philipp.hock@uni-ulm.de>
*/
defined('SEC_MENSA') or die('Restricted access');

/**
 * Interface to render a specific page
 */
interface Renderable{
    
    /**
     * @return string the title to show in the html head section
     */
    public function getTitle();
    
    /**
     * prints out any content to shown after the html head section.
     * This includes <html><body> and </body></html>
     * Note that the return value is void
     */
    public function writeContent();    
}