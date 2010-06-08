<?php
require_once("useSessionAppInfoIfPresent.php");

function didItWorkNotEmpty($out){
	if($out != ''){
		echo 'It Works!';
	}
	else{
		echo 'It Doesnt Work...';
		var_dump($out);
	}
}
function didItWorkInt($out){
	if(is_int($out)){
		echo 'It Works!';
	}
	else{
		echo 'It Doesnt Work...';
		var_dump($out);
	}
}

function didItWorkNonEmptyArray($out){
	if(is_array($out) && count($out) > 0){
		echo 'It Works!';
	}
	else{
		echo 'It Doesnt Work...';
		var_dump($out);
	}
}

function didItWorkObject($out){
	if(is_object($out) && $out->Id != ''){
		echo 'It Works!';
	}
	else{
		echo 'It Doesnt Work...';
		var_dump($out);
	}
}
