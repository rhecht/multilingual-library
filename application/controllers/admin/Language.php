<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends Admin_Controller{
	function __construct(){
    	parent::__construct();    	
    	$this->data['categories'] = $this->language_m->get_all();		
  		
  	}

  	public function index(){
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    

        if (!$this->isUserAllowed('adminstrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }

  		$this->render('admin/language/list','admin_master');
  	}

  	/*
		this controls how json is outputed for datatables
  	*/
  	public function ajax_list(){                       
      $this->datatables->select('LanguageID, Language, Language_he, Language_es, Language_fr, Language_ru, (SELECT COUNT(*) FROM article WHERE article.LanguageID = language.LanguageID) AS TotalArticles');
    	$this->datatables->from($this->language_m->_table);    			        		
		  $edit = '<a href="'.site_url('admin/language/edit/$1').'" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>'; 
      $delete ='<a href="'.site_url('admin/language/delete/$1').'" onclick="return confirm(\''.lang('Confirm Delete').'\');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';       
		  $this->datatables->add_column('action', $edit.$delete, 'LanguageID');			
		  echo $this->datatables->generate('json');
		  //echo "/*" . $this->datatables->last_query() . "*/";              
  	}

  	protected function _is_data_valid(){
  		
  		$this->form_validation->reset_validation();                        
        
        $this->form_validation->set_rules('language', 'Language', 'trim|required');
        $this->form_validation->set_rules('language_he', 'Language (Hebrew)', 'trim|required');       

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
  		if($this->input->post('action') == 'add_language'){
  			if($this->_is_data_valid()){
  				$language = array(  					
					'Language' 			=> 		$this->input->post('language'),
					'Language_he'		=> 		$this->input->post('language_he'),					
					'Language_es'		=> 		$this->input->post('language_es'),
					'Language_fr'		=> 		$this->input->post('language_fr'),
					'Language_ru'		=> 		$this->input->post('language_ru'),
  				);
  				
  				if( $LanguageID = $this->language_m->insert($language) ){
  					$this->generateMessage('success','Language added successfully');
  					redirect('admin/language');
  				}
  			}  		
  		}

  		$this->render('admin/language/add','admin_master');	
  	}

  	public function edit($id=0){
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    
        if (!$this->isUserAllowed('adminstrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }

        if(!$this->language_m->get($id)){
  			$this->generateMessage('warning','Language ID '.$id.' does not exist');
  			redirect('admin/Language');
  		}

  		if($this->input->post('action') == 'edit_language'){
  			if($this->_is_data_valid()){
  				$language = array(  					
					'Language' 			=> 		$this->input->post('language'),
					'Language_he'		=> 		$this->input->post('language_he'),					
					'Language_es'		=> 		$this->input->post('language_es'),
					'Language_fr'		=> 		$this->input->post('language_fr'),
					'Language_ru'		=> 		$this->input->post('language_ru'),
  				);
  				
  				if( $languageID = $this->language_m->update($id,$language) ){
  					$this->generateMessage('success','Language updated successfully');
  					redirect('admin/language/edit/'.$id);
  				}
  			}  		
  		}

  		$this->data['record'] = $this->language_m->get($id);
  		$this->render('admin/language/edit','admin_master');	
  	}

  	public function delete($id=0){  		
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    

        if (!$this->isUserAllowed('adminstrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }

        if(!$this->language_m->get($id)){
  			$this->generateMessage('warning','Language ID '.$id.' does not exist');
  			redirect('admin/language');
  		}
		
  		// check if Language has articles
		if($this->article_m->get_by('LanguageID',$id)){
			$this->generateMessage('warning','Language has articles');
			redirect('admin/language');
		}	
		
  		if( $this->language_m->delete($id) ){
  			$this->generateMessage('success',"Language deleted.");    		
  		}else{
  			$this->generateMessage('danger',"Couldn't delete Language.");    		
  		}
  		$this->render('admin/language/list','admin_master');
  	}

}
