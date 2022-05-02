<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Public_Controller {

	function __construct(){
    	parent::__construct();        
    	
    	
  	}

	
	public function index(){
		$this->data['categories'] = $this->category_m->order_by('Category','ASC')->get_all();
  		$this->data['mediatypes'] = $this->mediatype_m->order_by('Media','ASC')->get_all();
  		$this->data['languages'] = $this->language_m->order_by('Language','ASC')->get_all();
  		$this->data['authors'] = $this->author_m->order_by('Name','ASC')->get_all();

		$this->render('main/main','main_master');
	}

	public function rss(){		
		
		if(!empty($_GET['term'])){
			$term = $_GET['term'];
		}else{
			$term = NULL;
		}		
		$query = array('term' => $term);
		$records = $this->article_m->search($query);

		//print_r($records);
		//$this->data['records'] = $this->article_m->get_all();		
		$this->data['records'] = $records;
		$this->load->view('main/rss_output',$this->data);
	}

	// return the number of articles from the parameters given
	public function update_filter(){	
		
		$this->data['primary'] 	= $primaryKey 	= $this->input->get('primary');
		$this->data['table'] 	= $table 		= $this->input->get('table');
		$this->data['label'] 	= $this->input->get('label');

		$query = array(
			'term' => $this->input->get('term'),
			'sort' => $this->input->get('xsort'),
			'categories' => $this->input->get('categories'),
			'mediatypes' => $this->input->get('mediatypes'),
			'languages'	 => $this->input->get('languages'),			
			'authors'    => $this->input->get('authors'),
		);
		$this->data['query'] = $query;

		switch($table){			
			case 'category' : 
				$orderby = 'Category';
				$ordertype = 'ASC';
			break;
			case 'language' : 
				$orderby = 'Language';
				$ordertype = 'ASC';
			break;
			case 'author' : 
				$orderby = 'Name';
				$ordertype = 'ASC';
			break;

			case 'mediatype' : 
				$orderby = 'Media';
				$ordertype = 'ASC';
			break;
			default : 
				$orderby = '';
				$ordertype = 'ASC';
			break;
		}

		$type = $this->input->get('type');

		//print_r($query);

		$records = $this->{$table.'_m'}->order_by($orderby,$ordertype)->unsubscribe('after_get','get_number_of_articles')->get_all();
		foreach($records as $key=>$record){			
			$q = array(
				'term' 	=> 	$this->input->get('term'),
				'id' 	=> 	$record->{$primaryKey},
				'table' => 	$table,
				'query' => $query,
			);
			$records[$key]->filtered_articles =  $this->{$table.'_m'}
				->unsubscribe('after_get','get_number_of_articles')
				->get_number_of_articles_by_term($q);			
			$records[$key]->table = $table;
			//create template
		}		
		$this->data['records'] = $records;
		$this->load->view('main/__includes/__result_'.$type,$this->data);			
	}

	public function api(){
		// check api key if it exists		
		$process=true;
		if( empty($_GET['api_key']) || empty($_GET['domain']) ){
			$data = array(
				'failed' => true,
				'description' => 'no api key found',
			);
			header('Content-Type: application/json');
			echo json_encode($data);
			die();
		}
		
		$apiKey = $_GET['api_key'];	
		$domain = $_GET['domain'];
		$process = $this->api_m->get_by(array('Key'=>$apiKey,'Domain'=>$domain));
		
		if(!$process){
			$data = array(
				'failed' => true,
				'description' => 'api key and domain not valid',
			);
			header('Content-Type: application/json');
			echo json_encode($data);
			die();
		}
		
		if(!empty($_GET['term'])){
			$term = $_GET['term'];
		}else{
			$term = NULL;
		}		
		$query = array('term' => $term);
		$records = $this->article_m->search($query);		
		if($records){
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
			$data = array(
				'failed' => true,
				'description' => 'no records found',
			);
		}

		header('Content-Type: application/json');
		echo json_encode($data);
		die();
		
	}

	// search
	public function search(){		
		$type = $this->input->get('type');
		$authors = $this->input->get('authors');		
		$query = array(
			'term' => $this->input->get('term'),
			'sort' => $this->input->get('sort'),
			'categories' => $this->input->get('categories'),
			'mediatypes' => $this->input->get('mediatypes'),
			'languages'	 => $this->input->get('languages'),	
			'action' 	=> $this->input->get('action'),		
		);
		if(!empty($authors) && $authors[0] !== 'null'){
			$query['authors'] = $authors;
		}		

		$articles = $this->article_m->search($query);
		$this->data['query'] = $query;
		$this->data['records']=$articles;	

		switch($type){ // output type			
			case 'html' : 			
				$this->load->view('main/html_output',$this->data);
			break;
			case 'json' : 
			default : 
				//echo json_encode($articles);
				$this->load->view('main/json_output',$this->data);
				//echo count($articles);
				//echo '<hr/>';
				//print_r($articles);
			break;
		} 
	}
}
