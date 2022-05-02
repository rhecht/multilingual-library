<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Public_Controller extends MY_Controller {
  function __construct(){
    
    parent::__construct();

    $this->load->model("Article_model", 'article_m');
    $this->load->model("Mediatype_model", 'mediatype_m'); 

    $this->load->model("Category_model", 'category_m'); 
    $this->load->model("Articletocategory_model", 'article_category_m'); 
    $this->load->model("Articletoauthor_model", 'article_author_m'); 

    $this->load->model("Language_model", 'language_m'); 
    
    $this->load->model("Author_model", 'author_m'); 
	//    echo 'This is from public controller';


	$this->data['body_class'] = 'page-main main-tekhelet';
  }
}