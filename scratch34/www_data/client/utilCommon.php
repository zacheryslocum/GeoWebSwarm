<?php

$SHOW_ERRORS = true;
if ($SHOW_ERRORS) {
    // php errors
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    // dont ignore graph warnings
    ini_set('gd.jpeg_ignore_warning', '0');
} else {
    // hide errors when false
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
    // ignore graph warnings
    ini_set('gd.jpeg_ignore_warning', '1');
}

//define('PROJECT_ROOT', "/" . array_slice(explode('/', dirname(__FILE__)), -1)[0]);
// manually define project roots:
define('PROJECT_ROOT', '/client');

define('PROJECT_GEOSERVER', 'http://gsman:8054/geoserver');

define('PROJECT_DATA', 'data/');

// Major Dependencies

// mySQL PDO database access
//require_once("phpsql/mysql_pdo.php");

// Graph/charts
//require_once("libraries/jpgraph-4.2.0-saintpeter/src/jpgraph.php");
//require_once("libraries/jpgraph-4.2.0-saintpeter/src/jpgraph_bar.php");
//require_once("libraries/jpgraph-4.2.0-saintpeter/src/jpgraph_line.php");
//require_once("phpsql/genJpGraph.php");

// tables
require_once("phpsql/genTable.php");
require_once("phpsql/genTableForm.php");

// Cross Site Request Forgery mitigation
require_once("libraries/csrf-protector/libs/csrf/csrfprotector.php");

class CustomLogger implements LoggerInterface
{
    public function log($message, $context = array())
    {
        echo $message;
        echo "<br/>";
    }
}

// Initialize the library with this logger
csrfProtector::init(null, null, new CustomLogger());

// sanitize values or arrays
function sanitizeAny($input = '')
{
    if (!is_array($input) || !count($input)) {
        return sanitizeValue($input);
    } else {
        return sanitizeArray($input);
    }
}

// sanitize one item
function sanitizeValue($input = '')
{
    $search = array(
        '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
        '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
        '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
        '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
    );
    return preg_replace($search, '', htmlspecialchars(trim($input)));
}

// recursively sanitize an array of arrays of arrays...
function sanitizeArray($data = array())
{
    foreach ($data as $k => $v) {
        if (!is_array($v) && !is_object($v)) { // deep enough to only be values? sanitize them now.
            $data[$k] = sanitizeValue($v);
        }
        if (is_array($v)) { // go deeper
            $data[$k] = sanitizeArray($v);
        }
    }
    return $data;
}

// Use this to clean up the post vars from the form a bit
// uses the sanitizeAny function. get_post_var should always be used in pages.
function get_post_var($var)
{
    if (isset($_POST[$var]) AND !empty($_POST[$var])) {
        $val = $_POST[$var];
        return sanitizeAny($val);
    } else {
        return null;
    }
}

// sanitize the URL parameters
function get_get_var($var)
{
    if (isset($_GET[$var])) {
        return sanitizeAny($_GET[$var]);
    } else {
        return null;
    }
}

// generate metadata buttons. Accepts an associative array of label=>link
// $inputArray = array("SanteeHQ_halfhourly_data_2003_2005" => PROJECT_DOWNLOADS . "/html/SanteeHQ_halfhourly_data_2003_2005.html");
// if inputArray has more than 4 entries, changes to a dropdown!
function show_multiple_metadata($inputArray = array())
{
    $outHTML = '';
    if (count($inputArray) > 4) {
        $outHTML = $outHTML
            . '<div class="dropdown">'
            . '<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">'
            . 'Metadata List'
            . '</button>'
            . '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
            foreach ($inputArray as $label => $link) {
                $outHTML .= '<a class="dropdown-item" target="_blank" href="'.$link.'">'.$label.'</a>';
            }
            $outHTML .= '</div></div>';
    } else {
        foreach ($inputArray as $label => $link) {
            $outHTML .= '<button type = "button" class="btn btn-gray btn-sm m-1" > '
                .'<a class="text-dark" target="_blank" href = "'.$link.'" > '.$label.'</a > '
                .'</button > ';
        }
    }
    return $outHTML;
}



