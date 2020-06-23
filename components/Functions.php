<?php
// use Yii;
/* ---------------------------------------------------------------------------------------------
 * Common Helper functions 
 * Don't put any query related method here. Below funcitons only for debug purpose
 * ---------------------------------------------------------------------------------------------
 */
global $preCss, $is_backtrace;
global $prof_timing, $prof_names;

$preCss = "style='border:1px solid #CCC;background-color:#EEE;padding:5px;margin-top:30px;'";
$is_backtrace = true;

/*
 * Formated print_r
 * Usage p($data,$data2,$data3);
 */
function p() {
    global $preCss;
    global $is_backtrace;
    $backtrace_txt = '';

    $op = '<div ' . $preCss . '>';
    if ($is_backtrace) {
        $bt = debug_backtrace();
        foreach ($bt as $key => $btrace) {
            if (!in_array($btrace["function"], ["p"])) {
                $debugArray = $btrace;
                break;
            }
        }		
        $backtrace_txt = '<div style="background-color:#DDD;padding:3px;margin-top:1px;"><b>' . $debugArray['file'] . '</b>: <b>' . $debugArray['line'] . '</b></div>';
    }
    $op .= $backtrace_txt;
    $args = func_get_args();
    foreach ($args as $k => $arg) {
        $op .= "<pre style='border: 1px dotted;padding:10px;background-color:#FFF;'>";
        if (is_array($arg) || is_object($arg)) {
            $op .= print_r($arg, true);
        } else {
            $op .= $arg;
        }
        $op .= "</pre><br />";
    }
    $op .= '</div><br />';
    echo $op;
}

function off_backtrace() {
    global $is_backtrace;
    $is_backtrace = false;
}

// Only print
function pr() {
    $args = func_get_args();
    call_user_func_array('p', $args);
}

// Print + exit
function pe() {
    $args = func_get_args();
    call_user_func_array('p', $args);
    exit();
}


/* @Desc Use Only for debug : echo + exit  e.g. ee("hello",1,array("My Value","Test Value"));
 * @params : string and array both allowed
 */

function ee() {
    $args = func_get_args();
    foreach ($args as $k => $arg) {
        if (is_array($arg)) {
            echo '<pre>';
            print_r($arg);
            echo '</pre>';
        } else {
            echo $arg;
        }
    }
    exit;
}

/* @Desc : Print anying no of times : e.g printNtimes('<br/>',10); */

function printNtimes($printValue, $no = 1) {
    for ($i = 1; $i <= $no; $i++) {
        echo $printValue;
    }
}

/*
 * @Var Dumper multiple e.g. vd($arr1,$arr2,$var1,$var2) and exit
 */
function vd() {
    global $preCss;
    global $is_backtrace;
    $backtrace_txt = '';

    echo '<div ' . $preCss . '>';
    if ($is_backtrace) {
        $bt = debug_backtrace();
        $debugArray = $bt[0];
        if (!isset($debugArray['file'])) {
            $debugArray = $bt[2];
        }
        $backtrace_txt = '<b>' . $debugArray['file'] . '</b>: <b>' . $debugArray['line'] . '</b><br/><br/>';
    }
    echo $backtrace_txt;
    $args = func_get_args();
    foreach ($args as $k => $arg) {
        if ($arg == 'exit') {
            exit;
        }
        echo "<pre style='border: 1px solid #ccc;padding:10px;'>";
        var_dump($arg);
        echo "</pre><br />";
    }
    echo '</div><br />';
}



function getP($exit = false) {
    if (isset($_GET) && !empty($_GET)) {
        pr($_GET);
        if ($exit)
            exit;
    }
}

function postP($exit = false) {
    if (isset($_POST) && !empty($_POST)) {
        pr($_POST);
        if ($exit)
            exit;
    }
}

function phpError(){
	ini_set("display_errors",'On');
	error_reporting(E_ALL);
}

function debugPhpError(){
	if(isset($_GET["phpEr"]) && $_GET["phpEr"] ===true){ phpError();}// Debug PHP Error from your end : add ?phpEr=true
}
debugPhpError();


/*Json Pretty Print*/
function jsonP($arr,$exit=true){
	global $preCss;
	global $is_backtrace;
	
	$op = "<div ".$preCss.">";
	 if ($is_backtrace) {
        $bt = debug_backtrace();
        foreach ($bt as $key => $btrace) {
            if (!in_array($btrace["function"], ["p"])) {
                $debugArray = $btrace;
                break;
            }
        }		
		$op .= '<div style="background-color:#DDD;padding:3px;margin-top:1px;"><b>' . $debugArray['file'] . '</b>: <b>' . $debugArray['line'] . '</b></div>';
    }

	$op .= "<pre style='border: 1px dotted;padding:10px;background-color:#FFF;'>";	
	if(is_array($arr)){
		$op .= json_encode($arr,JSON_PRETTY_PRINT);
	}else{
		$op .= json_encode(json_decode($arr),JSON_PRETTY_PRINT);
	}
	$op .= "</pre><br/>";
	
	$op .= "</div>";
	echo $op;	
	if($exit)exit();
}

/*@Desc: For Debuging Print. It will show only if you pass debug=1 in query string */
function dpr(){
	if(isset($_GET["debug"]) && $_GET["debug"]==1){
	   $args = func_get_args();
	   call_user_func_array('p', $args);
	}
}

/*@Desc: For Debuging Print. It will show only if you pass debug=1 in query string */
function dpe(){
	if(isset($_GET["debug"]) && $_GET["debug"]==1){
	   $args = func_get_args();
	   call_user_func_array('p', $args);
	   exit();
	}
}

/*
Yii:: Query and Data Print 
@$qry: object of query 
*/
function qpr($qry,$data=''){
	$data ?	pr($qry->createCommand()->rawSql,$data):pr($qry->createCommand()->rawSql);
}
/* Yii:: Query and Data Print + exit
 *  @$qry: object of query 
 */
function qpe($qry,$data=''){
	$data ?	pe($qry->createCommand()->rawSql,$data):pe($qry->createCommand()->rawSql);
}