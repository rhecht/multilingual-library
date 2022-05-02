<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Author extends Admin_Controller{
	function __construct(){
    	parent::__construct();    	
    	$this->data['authors'] = $this->author_m->get_all();		
  		
  	}

  	public function index(){
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    

        if (!$this->isUserAllowed('adminstrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }

  		$this->render('admin/author/list','admin_master');
  	}

  	/*
		this controls how json is outputed for datatables
  	*/
  	public function ajax_list(){                       
      $this->datatables->select('authorID, Name, Name_he, Name_es, Name_fr, Name_ru, (SELECT COUNT(*) FROM articletoauthor WHERE articletoauthor.AuthorID = author.AuthorID) AS TotalAuthors');
    	$this->datatables->from($this->author_m->_table);    			        
		
		  $edit = '<a href="'.site_url('admin/author/edit/$1').'" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>'; 
      $delete ='<a href="'.site_url('admin/author/delete/$1').'" onclick="return confirm(\''.lang('Confirm Delete').'\');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>'; 
       
		  $this->datatables->add_column('action', $edit.$delete, 'authorID');			
		  echo $this->datatables->generate('json');
		  //echo "/*" . $this->datatables->last_query() . "*/";              
  	}

  	protected function _is_data_valid(){
  		
  		$this->form_validation->reset_validation();                        
        
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('name_he', 'Name (Hebrew)', 'trim');  
        $this->form_validation->set_rules('picture_url', 'Picture URL', 'trim');       
        $this->form_validation->set_rules('bio', 'Bio', 'trim');       

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
  		if($this->input->post('action') == 'add_author'){
  			if($this->_is_data_valid()){
  				$author = array(  					
					 'Name' 			=> 		$this->input->post('name'),
					 'Name_he'		=> 		$this->input->post('name_he'),
					 'Name_es'		=> 		$this->input->post('name_es'),	
					 'Name_fr'		=> 		$this->input->post('name_fr'),	
					 'Name_ru'		=> 		$this->input->post('name_ru'),	
           'PictureURL'    =>    $this->input->post('picture_url'),          
           'Bio'    =>    $this->input->post('bio'),
  				);
  				
  				if( $authorID = $this->author_m->insert($author) ){
  					$this->generateMessage('success','author added successfully');
  					redirect('admin/author');
  				}
  			}  		
  		}

  		$this->render('admin/author/add','admin_master');	
  	}

  	public function edit($id=0){
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    
        if (!$this->isUserAllowed('adminstrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }

        if(!$this->author_m->get($id)){
  			$this->generateMessage('warning','Author ID '.$id.' does not exist');
  			redirect('admin/author');
  		}

  		if($this->input->post('action') == 'edit_author'){
  			if($this->_is_data_valid()){
  				$author = array(            
           'Name'       =>    $this->input->post('name'),
           'Name_he'    =>    $this->input->post('name_he'),          
           'Name_es'    =>    $this->input->post('name_es'),          
           'Name_fr'    =>    $this->input->post('name_fr'),          
           'Name_ru'    =>    $this->input->post('name_ru'),          
           'PictureURL'    =>    $this->input->post('picture_url'),          
           'Bio'    =>    $this->input->post('bio'),
          );
  				
  				if( $authorID = $this->author_m->update($id,$author) ){
  					$this->generateMessage('success','Author updated successfully');
  					redirect('admin/author/edit/'.$id);
  				}
  			}  		
  		}

  		$this->data['record'] = $this->author_m->get($id);
  		$this->render('admin/author/edit','admin_master');	
  	}

  	public function delete($id=0){  		
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    

        if (!$this->isUserAllowed('adminstrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }

        if(!$this->author_m->get($id)){
  			$this->generateMessage('warning','author ID '.$id.' does not exist');
  			redirect('admin/author');
  		}
		
  		// check if author has articles
  		if($this->article_author_m->get_by('authorID',$id)){
  			$this->generateMessage('warning','author has articles');
  			redirect('admin/author');
  		}	
		
  		if( $this->author_m->delete($id) ){
  			$this->generateMessage('success',"author deleted.");    		
  		}else{
  			$this->generateMessage('danger',"Couldn't delete author.");    		
  		}
  		$this->render('admin/author/list','admin_master');
  	}

}
