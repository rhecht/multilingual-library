<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Language_model extends MY_Model {

    public $_table = 'language';    
    public $primary_key = 'LanguageID';

    protected $after_get = array('get_number_of_articles');

    protected function get_number_of_articles($row){
        if(!empty($row)){
            $row->total_articles = $this->article_m->unsubscribe('after_get','get_additional_data')->count_by(array('LanguageID'=>$row->LanguageID,'status'=>1));

        }
        return $row;
    }

    protected function get_number_of_articles_by_term($query){
        /*
        $this->db->distinct();
        $this->db->select('article.ArticleID');
        //$this->db->join('articletocategory','article.ArticleID = articletocategory.ArticleID','inner');
        $this->db->join('language','language.LanguageID = article.LanguageID','inner');
        $this->db->where('language.LanguageID',$query['id']);
        if(!empty($query['term'])){
            $this->db->group_start();
            $this->db->or_like('Title',$query['term']);
            $this->db->or_like('Publication',$query['term']);
            $this->db->or_like('Abstract',$query['term']);
            $this->db->or_like('Keywords',$query['term']);        
            $this->db->group_end(); 

        }
        return $this->db->count_all_results('article');    
        */

        $records = $this->article_m->search($query);
        $count = 0;
        foreach($records as $record){            
            //foreach($record->Categories as $category){
            if($record->LanguageID == $query['id']){
                $count++;
            }
            //}            
        }
        return $count;          
    }
}