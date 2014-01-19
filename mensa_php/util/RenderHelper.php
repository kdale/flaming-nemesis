<?php
/**
* File RenderHelper.php
* Simple helper functions for rendering JSON content into structured HTML
* @author Kristal Dale <kristal.dale@uni-ulm.de>
*/

class RenderHelper{
    private static $locs = array("Mensa", "Bistro", "West", "Prittwitzstr"); 
    private static $cssColors = array("bd_blue", "bd_red", "bd_grn", "bd_yel");
    private static $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
    
    /**
     * Function to render a week summary of all Mensa locations
     * @param type $jsonObj
     * @return string of html for display
     */
    public static function renderSummary($jsonObj){
        $week = $jsonObj->weeks[0]->days;
        $curStartDate = $week[0]->date; // use the first day of the current week as our "week of" date

        $html = '<article><h1>Menu plan for the week of ' . $curStartDate . '</h1>';

        // we have multiple locations i.e. multiple tables to display
        foreach (self::$locs as $value) {
            $html .= self::renderTable($value, $week);
        }

        $html .= '</article>';

        return $html;
    }
    
     /**
     * Function to render a detail for a specific location and day
     * @param type $jsonObj
     * @return string of html for display
     */
    public static function renderLocDay($jsonObj){
        $date = $_GET['date'];
        $location = ucfirst($_GET['loc']); // we want to standardise capitalization
        $html = '';
        
        // find our current day and location
        if(!empty($location) && !empty($date)){
            foreach($jsonObj->weeks[0]->days as $day) {
                if ($day->date == $date){ // found our date i.e. valid date
                    if(in_array($location, self::$locs)){ // valid location
                        $html .= '<article class="day"><h1>' . $location . ' plan for ' . $date . '</h1>';

                        foreach($day->$location->meals as $curMeal) {
                            $html .= '<Section class="bd ' . self::$cssColors[array_rand(self::$cssColors)] . '"><header><h2>' . $curMeal->category . '</h2></header><img src="/img/demo.jpeg" alt="demo image" class="img_l"/><p>' . $curMeal->meal . '</p></Section>';
                        }

                        $html .= '</article>';
                    }
                }
            }
        }

        if (empty($html)) {
            $html .= '<article class="day"><h1>Oops!</h1><p> There is no menu plan for the requested date and/or location - please check the main <a href="/">Mensa plan</a> for the current information.</p>';
        }
        
        return $html;   
    }
    
    /**
    * Render a summary table of the meal plan for a given location
    * @param string $location
    * @param array $week
    * @return string of html for display
    */
   public static function renderTable($location, $week) {
       // start the table
       $tableHtml = '<h2>' . $location . '</h2><table><thead><tr><th>Day</th>';

       // build the table header categories dynamically
       foreach ($week[0]->$location->meals as $curMeal) {
           $tableHtml .= '<th>' . $curMeal->category . '</th>';
       }

       $tableHtml .= '</tr></thead>';

       // for each day, build a row
       foreach ( $week as $key=>$value) {
           $tableHtml .=  '<tr><th data-title="Category"><a href="/' . $location . '/' . $value->date . '">' . self::$days[$key] . '</a></th>';

           // for each category in the current day, add a column
           foreach ($value->$location->meals as $curMeal) {
               $tableHtml .= '<td data-title="' . $curMeal->category . '">' . $curMeal->meal . '</td>';
           }

           $tableHtml .= '</tr>';
       }

       $tableHtml .= '</table>';

       return $tableHtml;
   }
}