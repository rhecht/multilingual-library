<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Author_model extends MY_Model {
    public $_table = 'author';    
    public $primary_key = 'AuthorID';

    protected $after_get = array('get_number_of_articles');

    protected function get_number_of_articles($row){
        if(!empty($row)){
            //$row->total_articles = $this->article_author_m->count_by('AuthorID',$row->AuthorID); 

            $num = 0;
            $articles = $this->article_author_m->get_many_by('AuthorID',$row->AuthorID);
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
    	

        $this->db->select('author.AuthorID');   
    	$this->db->join('articletoauthor','author.AuthorID = articletoauthor.AuthorID','left');
    	$this->db->join('article','article.ArticleID = articletoauthor.ArticleID','left');
        $this->db->where('author.AuthorID',$query['id']);
        $this->db->where('article.status', 1);
        if(!empty($query['term'])){
            $this->db->group_start();
            $this->db->or_like('article.Title',$query['term']);
            $this->db->or_like('article.Publication',$query['term']);
            $this->db->or_like('article.Abstract',$query['term']);
            $this->db->or_like('article.Keywords',$query['term']);        
            $this->db->or_like('author.Name',$query['term']);
            $this->db->or_like('author.Name_he',$query['term']);
            $this->db->or_like('author.Name_es',$query['term']);        
            $this->db->or_like('author.Name_fr',$query['term']);        
            $this->db->or_like('author.Name_ru',$query['term']);        
            $this->db->group_end(); 

        }
        //$this->db->group_by('author.AuthorID');
        $x = $this->db->count_all_results('author');                
        //echo $this->db->last_query();
        return $x;
/*

        $records = $this->article_m->search($query);
        $count = 0;
        foreach($records as $record){            
            foreach($record->Authors as $author){
                if($author->AuthorID == $query['id']){
                    $count++;
                }
            }            
        }
        return $count;
        
*/
	}    

}