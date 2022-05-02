<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mediatype_model extends MY_Model {

    public $_table = 'mediatype';    
    public $primary_key = 'MediaTypeID';

    protected $after_get = array('get_number_of_articles');

    protected function get_number_of_articles($row){
        if(!empty($row)){
            $row->total_articles = $this->article_m->unsubscribe('after_get','get_additional_data')->count_by(array('MediaTypeID'=>$row->MediaTypeID,'status'=>1)); 
        }
        return $row;
    } 

    protected function get_number_of_articles_by_term($query){
        
        /*$this->db->select('mediatype.MediaTypeID');        
        $this->db->join('article','article.MediaTypeID = mediatype.MediaTypeID','right');
        $this->db->where('mediatype.MediaTypeID',$query['id']);
        $this->db->where('article.status',1);
        if(!empty($query['term'])){
            $this->db->group_start();
            $this->db->or_like('Title',$query['term']);
            $this->db->or_like('Publication',$query['term']);
            $this->db->or_like('Abstract',$query['term']);
            $this->db->or_like('Keywords',$query['term']);        
            $this->db->or_like('Media',$query['term']);        
            $this->db->or_like('Media_he',$query['term']);        
            $this->db->group_end(); 

        }     
        return $this->db->count_all_results('media');              
        */

        $records = $this->article_m->search($query);
        $count = 0;
        foreach($records as $record){            
            //foreach($record->Categories as $category){
            if($record->MediaTypeID == $query['id']){
                $count++;
            }
            //}            
        }
        return $count;          
    }    
}