<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!empty($records)){
	// add header for json
	$data = array(
		'success' => true,
		'total' => count($records),		
	);
	foreach($records as $row){
		$data['records'][] = array(
			'title' 			=> $row->Title,
			'publication' 		=> $row->Publication,
			'language' 			=> $row->Language,
			'link' 				=> $row->URL,
			'abstract' 			=> $row->Abstract,
			'keywords'			=> $row->Keywords,
			'publicationyear'	=> $row->PublicationYear,
			'size'				=> $row->Size,			
			'status'			=> $row->status,				
			'description'		=> $row->Abstract,
			'pubDate'			=> $row->PublicationYear,
		);
	}
}else{
	if(empty($data)){
		$data = array(
			'failed' => true,
			'description' => 'no search result found',
		);
	}else{
		// data has content from controller
	}
}
header('Content-Type: application/json');
echo json_encode($data);