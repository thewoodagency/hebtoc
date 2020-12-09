<?php # Script 2.1 - config.inc.php

/* 
 *  File name: config.inc.php
 *  Created by: Jay Jung
 *  Last modified: June 4, 2018
 *  
 */

# ******************** #
# ***** SETTINGS ***** #
date_default_timezone_set('America/Chicago');

// Errors are emailed here:
$contact_email = 'jay@thewoodagency.com'; 

// Determine whether we're working on a local server
// or on the real server:
$host = substr($_SERVER['HTTP_HOST'], 0, 5);
if (in_array($host, array('local', '127.0', '192.1'))) {
    $local = TRUE;
} else {
    $local = FALSE;
}

// Determine location of files and the URL of the site:
// Allow for development on different servers.
if ($local) {

    // Always debug when running locally:
    $debug = TRUE;

    // Define the constants:
    define('BASE_URI', '/path/to/html/folder/');
    define('BASE_URL', 'http://localhost/directory/');
    define('DB', '/path/to/mysql.inc.php');

} else {
    define('BASE_URI', '/home/httpd/vhosts/hebtoc.com/httpdocs/');
    define('BASE_URL', 'http://www.hebtoc.com/new_/');
    define('DB', '/includes/mysqli_connect.php');
    define('DBHOST', 'mysql51-039.wc1.ord1.stabletransit.com');
    define('DBUSER', '976970_tocuser');
    define('DBPASS', 'tWa198920');
    define('DBNAME', '976970_toc');
}

//$dbc = new mysqli("mysql51-039.wc1.ord1.stabletransit.com", "976970_tocuser", "tWa198920", "976970_toc");
/* 
 *  Most important setting!
 *  The $debug variable is used to set error management.
 *  To debug a specific page, add this to the index.php page:

if ($p == 'thismodule') $debug = TRUE;
require('./includes/config.inc.php');

 *  To debug the entire site, do

$debug = TRUE;

 *  before this next conditional.
 */

// Assume debugging is off. 
if (!isset($debug)) {
    $debug = FALSE;
}

# ***** SETTINGS ***** #
# ******************** #


# **************************** #
# ***** ERROR MANAGEMENT ***** #

// Create the error handler:
function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars) {

    global $debug, $contact_email;
    
    // Build the error message:
    $message = "An error occurred in script '$e_file' on line $e_line: $e_message";
    
    // Append $e_vars to the $message:
    $message .= print_r($e_vars, 1);
    
    if ($debug) { // Show the error.
    
        echo '<div class="error">' . $message . '</div>';
        debug_print_backtrace();
        
    } else { 

        // Log the error:
        error_log ($message, 1, $contact_email); // Send email.

        // Only print an error message if the error isn't a notice or strict.
        if ( ($e_number != E_NOTICE) && ($e_number < 2048)) {
            echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div>';
        }

    } // End of $debug IF.

} // End of my_error_handler() definition.

// Use my error handler:
set_error_handler('my_error_handler');

# ***** ERROR MANAGEMENT ***** #
# **************************** #