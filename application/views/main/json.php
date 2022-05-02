<?php
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
?>
<?php  $counter=0; ?>{"articles":[<?php foreach ($records as $key => $items): ?>
<?php if($counter>0){ ?>,<?php } ?>
{
"title":"<?php echo fixString(xml_convert($items->Title)); ?>",
"publication":"<?php echo fixString($items->Publication); ?>",
"language":"<?php echo fixString($items->Language); ?>",
"link":"<?php echo fixString($items->URL) ?>",
"mediatype":"<?php echo fixString($items->MediaType) ?>",
"abstract":"<?php echo fixString($items->Abstract) ?>",
"keywords":"<?php echo fixString($items->Keywords) ?>",
"publicationyear":"<?php echo fixString($items->PublicationYear) ?>",
"size":"<?php echo fixString($items->Size) ?>",
"languageid":"<?php echo fixString($items->LanguageID) ?>",
"mediatypeid":"<?php echo $items->MediaTypeID ?>",
"status":"<?php echo fixString($items->status) ?>",
"description":"<?php echo fixString($items->Abstract); ?>",
"pubDate":"<?php echo fixString($items->PublicationYear); ?>"
}
<?php $counter++; ?>
<?php endforeach; ?>
]}