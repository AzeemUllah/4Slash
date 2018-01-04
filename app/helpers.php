<?php

if ( ! function_exists('config_path'))  
{
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}

/****** CALCULATE DATE & TIME *******/
function messageSince($dateTime) {

    $datetime1 = new DateTime(); // Today's Date/Time
    $datetime2 = new DateTime($dateTime);
    $interval = $datetime1->diff($datetime2);
    if($interval->format('%D') == '00') {
        if($interval->format('%H') == '00') {
            if($interval->format('%I') == '00') {
                return 'Just Now';
            } else {
                return $interval->format('%I minutes ago');
            }
        } else {
            return $interval->format('%H hours ago');
        }
    }
    else {
        return $interval->format('%D days ago');
    }

}


	