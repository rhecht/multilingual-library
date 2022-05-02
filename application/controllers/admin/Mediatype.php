<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mediatype extends Admin_Controller{
	function __construct(){
    	parent::__construct();    	
    	$this->data['authors'] = $this->mediatype_m->get_all();		
  		
  	}

  	public function index(){
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    

        if (!$this->isUserAllowed('adminstrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }

  		$this->render('admin/mediatype/list','admin_master');
  	}

  	/*
		this controls how json is outputed for datatables
  	*/
  	public function ajax_list(){                       
      $this->datatables->select('MediaTypeID, Media, Media_he, Media_es, (SELECT COUNT(*) FROM article WHERE article.MediaTypeID = mediatype.MediaTypeID) AS TotalArticles');
    	$this->datatables->from($this->mediatype_m->_table);    			        
		
		  $edit = '<a href="'.site_url('admin/mediatype/edit/$1').'" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>'; 
      $delete ='<a href="'.site_url('admin/mediatype/delete/$1').'" onclick="return confirm(\''.lang('Confirm Delete').'\');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>'; 
       
		  $this->datatables->add_column('action', $edit.$delete, 'MediaTypeID');			
		  echo $this->datatables->generate('json');
		  //echo "/*" . $this->datatables->last_query() . "*/";              
  	}

  	protected function _is_data_valid(){
  		
  		$this->form_validation->reset_validation();                        
        
        $this->form_validation->set_rules('media', 'Media Type', 'trim|required');
        $this->form_validation->set_rules('media_he', 'Media Type (Hebrew)', 'trim|required');       
        $this->form_validation->set_rules('icon_url', 'Icon URL', 'trim|valid_url');

        $this->form_validation->set_error_delimiters('<li class="error-item"><i class="fa fa-times-circle" aria-hidden="true"></i> ','</li>');

        return $this->form_validation->run();
  	}
  	
  	public function add(){
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    
        if (!$this->isUserAllowed('adminstrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }
  		if($this->input->post('action') == 'add_media'){
  			if($this->_is_data_valid()){
  				$media = array(  					
					 'Media' 			=> 		$this->input->post('media'),
					 'Media_he'		=> 		$this->input->post('media_he'),
					 'Media_es'		=> 		$this->input->post('media_es'),
					 'Media_fr'		=> 		$this->input->post('media_fr'),	
					 'Media_ru'		=> 		$this->input->post('media_ru'),	
           'IconURL'    =>    $this->input->post('icon_url'),                     
  				);
  				
  				if( $authorID = $this->mediatype_m->insert($media) ){
  					$this->generateMessage('success','Media Type added successfully');
  					redirect('admin/mediatype');
  				}
  			}  		
  		}

  		$this->render('admin/mediatype/add','admin_master');	
  	}

  	public function edit($id=0){
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    
        if (!$this->isUserAllowed('adminstrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }

        if(!$this->mediatype_m->get($id)){
  			$this->generateMessage('warning','Media Type ID '.$id.' does not exist');
  			redirect('admin/mediatype');
  		}

  		if($this->input->post('action') == 'edit_media'){
  			if($this->_is_data_valid()){
  				$media = array(           
           'Media'      =>    $this->input->post('media'),
           'Media_he'   =>    $this->input->post('media_he'),         
           'Media_es'   =>    $this->input->post('media_es'),         
           'Media_fr'   =>    $this->input->post('media_fr'),         
           'Media_ru'   =>    $this->input->post('media_ru'),         
           'IconURL'    =>    $this->input->post('icon_url'),                     
          );
  				
  				if( $authorID = $this->mediatype_m->update($id,$media) ){
  					$this->generateMessage('success','Media Type updated successfully');
  					redirect('admin/mediatype/edit/'.$id);
  				}
  			}  		
  		}

  		$this->data['record'] = $this->mediatype_m->get($id);
  		$this->render('admin/mediatype/edit','admin_master');	
  	}

  	public function delete($id=0){  		
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    

        if (!$this->isUserAllowed('adminstrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }

        if(!$this->mediatype_m->get($id)){
  			$this->generateMessage('warning','Media Type ID '.$id.' does not exist');
  			redirect('admin/mediatype');
  		}
		
  		// check if Media Type has articles
  		if($this->article_m->get_by('MediaTypeID',$id)){
  			$this->generateMessage('warning','Media Type has articles');
  			redirect('admin/mediatype');
  		}	
		
  		if( $this->mediatype_m->delete($id) ){
  			$this->generateMessage('success',"Media Type deleted.");    		
  		}else{
  			$this->generateMessage('danger',"Couldn't delete Media Type.");    		
  		}
  		$this->render('admin/mediatype/list','admin_master');
  	}

}
