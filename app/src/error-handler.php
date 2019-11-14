<?php
function SetInternalError($errno = null, $errstr = null, $errfile = null, $errline = null){
    http_response_code(500);
    echo'<h1>Error</h1>';

    
    switch ($errno) {
        case E_USER_ERROR:
                echo '<strong>ERROR<strong>['. $errno .']' . $errstr . "<br>\n";
                echo 'Fatal error in line'. $errline .'in file' . $errfile;
            break;

        case E_USER_WARNING:
                echo '<strong>WARNING<strong>['. $errno .']' . $errstr . "<br>\n";                
            break;

        case E_USER_NOTICE:
                echo '<strong>NOTICE<strong>['. $errno .']' . $errstr . "<br>\n";                
            break;

        default:
        echo 'Unknow error type['. $errno .']' . $errstr . "<br>\n";
            break;
    }
}

set_error_handler("SetInternalError");
set_exception_handler("SetInternalError");