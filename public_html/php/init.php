<?php
require_once($_SERVER['DOCUMENT_ROOT']."/php/db.php");

function init_system()
{
	if(session_id() == "")
		session_start();
		
	loaddb($_SERVER['DOCUMENT_ROOT']."/db/global.db", -1); // load global settings
	loaddb($_SERVER['DOCUMENT_ROOT']."/db/0.db", 0); // load action database
}

function mb_trim( $string )
{
	$string = preg_replace( "/(^\s+)|(\s+$)/us", "", $string );
	return $string;
} 

function formspecialchars($var)
{
	$pattern = '/&(#)?[a-zA-Z0-9]{0,};/';
   
	if (is_array($var)) {    // If variable is an array
		$out = array();      // Set output as an array
		foreach ($var as $key => $v) {     
			$out[$key] = formspecialchars($v);
		}
	} else {
		$out = $var;
		while (preg_match($pattern,$out) > 0) {
			$out = htmlspecialchars_decode($out,ENT_QUOTES);      
		}                            
		$out = htmlspecialchars(stripslashes(trim($out)), ENT_QUOTES,'UTF-8',true);
	}
	return $out;
}

function NlToBr($inString)
{
	$inString = preg_replace("%\n%", "<br />", $inString);
	$inString = str_replace("\n",'',$inString);
	return str_replace("\r",'',$inString);
}

function BrToNl($inString)
{
	return str_replace("<br />","\n",$inString);
}

?>