<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Article_model extends MY_Model {

    public $_table = 'article';    
    public $primary_key = 'ArticleID';
    //protected $deleted_at_key = 'deleted_at';
    //protected $soft_delete = FALSE;

    //protected $before_create = array('get_additional_data');
    protected $after_get = array('get_additional_data');

    protected function get_additional_data($row){
    echo 'get additional data article';    	
        if(!empty($row)){
    		// get author and place them in array
    		$categories = $this->article_category_m->get_many_by('ArticleID',$row->ArticleID);
    		$row->Categories = array();
            foreach($categories as $category){
    			$row->Categories[] = $category->CategoryID;
    		}  
    		$authors = $this->article_author_m->get_many_by('ArticleID',$row->ArticleID);	
    		$row->Authors=array();
            foreach($authors as $author){
    			$row->Authors[] = $author->AuthorID;
    		}
    		
    	}
    	return $row;
    }
    protected function search($query){

        // will not use my_model, but use custom query instead        
        $this->db->distinct();
        $this->db->select('
            article.ArticleID, 
            article.Title, 
            article.Publication, 
            article.URL,
            article.Abstract,
            article.Keywords,
            article.Size,
            article.status,
            article.PublicationYear,
            category.Category,
            category.Category_he,
            category.Category_es,
            category.Category_fr,
            category.Category_ru,
            author.Name,
            author.Name_he,
            author.Name_es,
            author.AuthorID,
            author.PictureURL,
            mediatype.Media,
            mediatype.Media_he,
            mediatype.Media_es,
            mediatype.Media_fr,
            mediatype.Media_ru,
            mediatype.MediaTypeID,
            mediatype.IconURL,
            language.Language,
            language.Language_he,
            language.Language_es,
            language.Language_fr,
            language.Language_ru,
            language.LanguageID,           
        ');        

        $this->db->join('articletocategory','article.ArticleID = articletocategory.ArticleID','left');
        $this->db->join('category','category.CategoryID = articletocategory.CategoryID','left');

        $this->db->join('articletoauthor','article.ArticleID = articletoauthor.ArticleID','left');
        $this->db->join('author','author.AuthorID = articletoauthor.AuthorID','left');

        $this->db->join('mediatype','mediatype.MediaTypeID = article.MediaTypeID','left');
        $this->db->join('language','language.LanguageID = article.LanguageID','left');
        
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
            $this->db->or_like('language.Language',$query['term']);
            $this->db->or_like('language.Language_he',$query['term']);
            $this->db->or_like('language.Language_es',$query['term']);
            $this->db->or_like('language.Language_fr',$query['term']);
            $this->db->or_like('language.Language_ru',$query['term']);
            $this->db->or_like('category.Category',$query['term']);
            $this->db->or_like('category.Category_he',$query['term']);
            $this->db->or_like('category.Category_es',$query['term']);
            $this->db->or_like('category.Category_fr',$query['term']);
            $this->db->or_like('category.Category_ru',$query['term']);
            $this->db->or_like('mediatype.Media',$query['term']);
            $this->db->or_like('mediatype.Media_he',$query['term']);
            $this->db->or_like('mediatype.Media_es',$query['term']);
            $this->db->or_like('mediatype.Media_fr',$query['term']);
            $this->db->or_like('mediatype.Media_ru',$query['term']);
            $this->db->group_end(); 

        }

        if(!empty($query['categories'])){
            $this->db->where_in('category.CategoryID',$query['categories']);
        }

        if(!empty($query['mediatypes'])){
            $this->db->where_in('mediatype.MediaTypeID',$query['mediatypes']);
        }

        if(!empty($query['languages'])){
            $this->db->where_in('language.LanguageID',$query['languages']);
        }
        
        if( !empty($query['authors']) ){
            if( is_array($query['authors']) ){
                $this->db->where_in('author.AuthorID', $query['authors'], FALSE );   
            }else{
                $this->db->where_in('author.AuthorID', explode(',',$query['authors']) );
            }    
			//die( print_r($query['authors']) ) ;
        }

        $this->db->group_by('article.ArticleID');

        //die(print_r($query['categories']));

        //$this->db->group_start();
        //$this->db->where('deleted_at >',"NOW()");
        //$this->db->or_where('deleted_at IS NULL',NULL);
        //$this->db->or_where('deleted_at',"0000-00-00 00:00:00");
        //$this->db->group_end();        

//		echo is_array($query['authors']);

        $this->db->where('status', 1);

        if(isset($query['sort'])){
            $sort = explode('-',$query['sort']);
            $this->db->order_by($sort[0],$sort[1]);
        }

       
        $records = $this->db->get('article')->result_object();      

//        echo $this->db->last_query();

        if($records){
            // loop thru each article and get the many categories it belong
            foreach($records as $key=>$row){
                $categories = $this->article_category_m->get_many_by('ArticleID',$row->ArticleID);
                $records[$key]->Categories = array();
                foreach($categories as $category){
                    $records[$key]->Categories[] = $this->category_m->unsubscribe('after_get','get_number_of_articles')->get($category->CategoryID);
                }  
                $authors = $this->article_author_m->get_many_by('ArticleID',$row->ArticleID);   
                $records[$key]->Authors=array();
                foreach($authors as $author){
                    $records[$key]->Authors[] = $this->author_m->unsubscribe('after_get','get_number_of_articles')->get($author->AuthorID);
                }
            }
        }else{
            //echo $this->db->last_query();
        }
        return $records;
    }


    
}