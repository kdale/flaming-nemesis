<?php
/**
* File MSystem.php
* @author Philipp Hock <philipp.hock@uni-ulm.de>
*/

defined('SEC_MENSA') or die('Restricted access');

/**
 * The system core class and main entry point of this framework
 * handles the routing 
 */
class MSystem{
    private $basepath;
    private static $url;
    private $securepaths=array();
    
    /**
    * Creates the main framework object
    * @param string $basepath relative path to the framework folder
    * @param string $url relative url to the root-dir of this framework
    * if your framework is available under http://yoururl.com/framework, 
    * $url must be 'framework'
    * 
    */
    public function __construct($basepath,$url) {
       $this->basepath = $basepath;
       MSystem::$url=$url;
       
       //generate whitelist for file access
       $content = $this->getContentList();
       
       foreach ($content as $c) {
           $this->putSecurePath($c, $c);
       }
       
    }
    
    /**
    * Inizializes the main framework object
    * this includes database and login mechanism
    */
    public function start(){
        
        if (isset($_GET['page'])){
            if ($_GET['page'] == ''){
                $this->loadPage();
            }else{
                $this->loadPage($_GET['page']);
            }

        }else{
            $this->loadPage();
        }
    }

    /**
    * loads a page into the content area
    * @param string page the page to load, 
    * all pages are in mensa_php/content/
    * The string is loaded as basepath . 'content/' . $page . '.php'
    * Note that any page loaded must be from Type Page
    * and must implement the interface Renderable
    */    
    private function loadPage($page='welcome'){
        if (Util::endsWith($page,'/')){
            $page = substr($page,0,-1);
        }
        $contentpath = $this->getSecurePath($page);
        
        if ($contentpath==null){
            $this->load404();
            return;
        }
        include $contentpath;
        $page = new Page();
        
        include $this->basepath . 'templates/header.php'; 
        $page->writeContent();
        include $this->basepath . 'templates/footer.php';
        
    }
    
    /**
     * loads the 404 page and sends the appropriate 404 header
     */
    private function load404(){
        header("HTTP/1.1 404 Not Found");
        include $this->basepath . 'templates/404.php';
    }
    

    /**
     * 
     * @param string $append to append at the baseURL
     * the baseurl has been set in the constructor
     * @return string the url to the framework, appended with 
     * the $append parameter given
     */
    public static function getBaseURL($append=''){
        return Util::url(MSystem::$url).$append;
    }
    
    /**
     * Returns a path associated with a keyword
     * to avoid directory traversal
     * @param string $keyword
     * @return The path associated with this keyword, null if no keyword exists
     */
    private function getSecurePath($keyword){
        if (!array_key_exists($keyword,$this->securepaths)){
            return null;
        }
        return $this->securepaths[$keyword];
    }
    
    /**
     * Creates a path to content/$file 
     * and associates it with the given keyword
     * to avoid directory traversal 
     * @param string $keyword
     * @param string $file
     */
    private function putSecurePath($keyword,$file){
        $path = realpath($this->basepath . 'content/' . $file . '.php');
        $this->securepaths[$keyword]=$path;
    }
    
    /**
     * 
     * @return string[] a list of all files in content/
     * without the file ending 
     */
    private function getContentList(){
       $ret = array(); 
       if ($handle = opendir($this->basepath . 'content/')) {
        while (false !== ($entry = readdir($handle))) {
             if ($entry != "." && $entry != "..") {
                 $ret[]=substr($entry,0,-4);
             }
         }
         closedir($handle);
        }
       return $ret;
    }
    
}