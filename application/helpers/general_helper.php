<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// ------------------------------------------------------------------------

function template_url($file='', $echo=true){
    if($echo){
        echo base_url().'assets/'.$file;    
    }else{
        return base_url().'assets/'.$file;
    }
}


function fixString($string){
//	$string=addcslashes($string, '"\\/'); //double, not single quotes
	$string=preg_replace( "/\r|\n/", " ", $string ); //line breaks
	$string = preg_replace('/[ ]{2,}|[\t]/', ' ', trim($string));//tabs with spaces
	$string = preg_replace('/\s+/', ' ', $string); //tabs with spaces 2
	$string = str_replace("", "", $string);
//	$string = htmlentities($string); //special characters
	$string = htmlspecialchars($string); //special characters
	$string = preg_replace('/[\x00-\x1f]/', '?', $string);//ascii characters
	
	return $string;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}