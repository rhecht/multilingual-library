<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends MY_Model {
    
    public $_table = 'category';    
    public $primary_key = 'CategoryID';

    protected $after_get = array('get_number_of_articles');

    protected function get_number_of_articles($row){
    	if(!empty($row)){
    		//$row->total_articles = $this->article_category_m->count_by('CategoryID',$row->CategoryID);
            $num = 0;
            $articles = $this->article_category_m->get_many_by('CategoryID',$row->CategoryID);
            foreach($articles as $article){
                if($this->article_m->unsubscribe('after_get','get_additional_data')->get_by( array('ArticleID'=>$article->ArticleID,'status'=>1) ) ){
                    $num++;
                }
            }

            $row->total_articles=$num;

    	}
    	return $row;
    }
    protected function get_number_of_articles_by_term($query){
    	//$this->db->distinct();
    	/*$this->db->select('category.CategoryID');
    	$this->db->join('articletocategory','category.CategoryID = articletocategory.CategoryID','right');
    	$this->db->join('article','article.ArticleID = articletocategory.ArticleID','right');
        $this->db->where('category.CategoryID',$query['id']);
        
        if(!empty($query['term'])){
            $this->db->group_start();
            $this->db->or_like('Title',$query['term']);
            $this->db->or_like('Publication',$query['term']);
            $this->db->or_like('Abstract',$query['term']);
            $this->db->or_like('Keywords',$query['term']); 
            $this->db->or_like('category.Category',$query['term']);
            $this->db->or_like('category.Category_he',$query['term']);
            $this->db->group_end(); 

        }

        //echo $this->db->last_query();
        return $this->db->count_all_results('category');*/


        $records = $this->article_m->search($query);
        $count = 0;
        foreach($records as $record){            
            foreach($record->Categories as $category){
                if($category->CategoryID == $query['id']){
                    $count++;
                }
            }            
        }
        return $count;

	}

}