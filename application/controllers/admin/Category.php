<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin_Controller{
	function __construct(){
    	parent::__construct();    	
    	$this->data['categories'] = $this->category_m->get_all();		
  		
  	}

  	public function index(){
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    

        if (!$this->isUserAllowed('adminstrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }

  		$this->render('admin/category/list','admin_master');
  	}

  	/*
		this controls how json is outputed for datatables
  	*/
  	public function ajax_list(){                       
      $this->datatables->select('CategoryID, Category, Category_he, Category_es, 
        (SELECT COUNT(*) FROM articletocategory WHERE articletocategory.CategoryID = category.CategoryID) AS TotalArticles');
    	$this->datatables->from($this->category_m->_table);

      
		
		  $edit   = '<a href="'.site_url('admin/category/edit/$1').'" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>'; 
      $delete ='<a href="'.site_url('admin/category/delete/$1').'" onclick="return confirm(\''.lang('Confirm Delete').'\');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>'; 
       
		$this->datatables->add_column('action', $edit.$delete, 'CategoryID');			
		
    echo $this->datatables->generate('json');
		//echo "/*" . $this->datatables->last_query() . "*/";              
  	}

  	protected function _is_data_valid(){
  		
  		$this->form_validation->reset_validation();                        
        
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        $this->form_validation->set_rules('category_he', 'Category (Hebrew)', 'trim|required');       

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
  		if($this->input->post('action') == 'add_category'){
  			if($this->_is_data_valid()){
  				$category = array(  					
					'Category' 			=> 		$this->input->post('category'),
					'Category_he'		=> 		$this->input->post('category_he'),					
					'Category_es'		=> 		$this->input->post('category_es'),
					'Category_fr'		=> 		$this->input->post('category_fr'),
					'Category_ru'		=> 		$this->input->post('category_ru'),
  				);
  				
  				if( $categoryID = $this->category_m->insert($category) ){
  					$this->generateMessage('success','Category added successfully');
  					redirect('admin/category');
  				}
  			}  		
  		}

  		$this->render('admin/category/add','admin_master');	
  	}

  	public function edit($id=0){
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    
        if (!$this->isUserAllowed('adminstrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }

        if(!$this->category_m->get($id)){
  			$this->generateMessage('warning','Category ID '.$id.' does not exist');
  			redirect('admin/category');
  		}

  		if($this->input->post('action') == 'edit_category'){
  			if($this->_is_data_valid()){
  				$category = array(  					
					'Category' 			=> 		$this->input->post('category'),
					'Category_he'		=> 		$this->input->post('category_he'),					
					'Category_es'		=> 		$this->input->post('category_es'),
					'Category_fr'		=> 		$this->input->post('category_fr'),
					'Category_ru'		=> 		$this->input->post('category_ru'),
  				);
  				
  				if( $categoryID = $this->category_m->update($id,$category) ){
  					$this->generateMessage('success','Category updated successfully');
  					redirect('admin/category/edit/'.$id);
  				}
  			}  		
  		}

  		$this->data['record'] = $this->category_m->get($id);
  		$this->render('admin/category/edit','admin_master');	
  	}

  	public function delete($id=0){  		
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    

        if (!$this->isUserAllowed('adminstrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }

        if(!$this->category_m->get($id)){
  			$this->generateMessage('warning','Category ID '.$id.' does not exist');
  			redirect('admin/category');
  		}
		
  		// check if category has articles
		if($this->article_category_m->get_by('CategoryID',$id)){
			$this->generateMessage('warning','Category has articles');
			redirect('admin/category');
		}	
		
  		if( $this->category_m->delete($id) ){
  			$this->generateMessage('success',"Category deleted.");    		
  		}else{
  			$this->generateMessage('danger',"Couldn't delete category.");    		
  		}
  		$this->render('admin/category/list','admin_master');
  	}

}
