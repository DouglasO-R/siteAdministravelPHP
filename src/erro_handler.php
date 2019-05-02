<?php

function setInternalServerError($errno = null,$errstr= null,$errfile= null,$errline= null){
    http_response_code(500);
    echo "<h1>Error</h1>";
    IF(!DEBUG){
        exit ;
    } 

    if(is_object($errno)){
        $err = $errno;
        $errno = $err->getCode();
        $errstr = $err->getMessage();
        $errfile = $err->getFile();
        $errline = $err->getLine();        

    }
    switch ($errno) {
        case E_USER_ERROR:
        ECHO "<STRONG>ERROR</STRONG>[". $errno ."]" . $errstr . "<br>\n" ;
        echo "fatal error on line" . $errline ."in file " . $errfile ;
            break;

            case E_USER_WARNING:
            ECHO "<STRONG>WARNING</STRONG>[". $errno ."]" . $errstr . "<br>\n" ;
            break;

            case E_USER_NOTICE:
            ECHO "<STRONG>NOTICE</STRONG>[". $errno ."]" . $errstr . "<br>\n" ;
            break;        
        
        default:
        ECHO "<STRONG>UNKNOW</STRONG>[". $errno ."]" . $errstr . "<br>\n" ;
        echo "fatal error on line" . $errline ."in file " . $errfile ;
            break;
    }
/*** necessita ativar xdebiug
    echo "<ul>";
    foreach (debug_backtrace() as $error) {
        if(!empty($error["file"])){
            echo"<li>";
            echo $errno[$file] . ":";
            echo $errno[$line] ;
            echo"</li>";
        }
    }
    echo "</ul>"
*/
    exit ;
}

set_error_handler("setInternalServerError");
set_exception_handler("setInternalServerError");