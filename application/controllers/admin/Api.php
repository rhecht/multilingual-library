<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends Admin_Controller{
	function __construct(){
    	parent::__construct();  		

      $this->data['users'] = $this->user_m->get_all();
  	}

  	public function index(){
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    

        if (!$this->isUserAllowed('administrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }

  		$this->render('admin/api/list','admin_master');
  	}

  	/*
		this controls how json is outputed for datatables
  	*/
  	public function ajax_list(){                       
      $this->datatables->select('ApiID, Key, Domain, UserID');
    	$this->datatables->from($this->api_m->_table);
      $delete ='<a href="'.site_url('admin/api/delete/$1').'" onclick="return confirm(\''.lang('Confirm Delete').'\');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>'; 
       
		$this->datatables->add_column('action', $delete, 'ApiID');			
		
    echo $this->datatables->generate('json');
		//echo "/*" . $this->datatables->last_query() . "*/";              
  	}

  	protected function _is_data_valid(){
  		
  		$this->form_validation->reset_validation();                        
        
        $this->form_validation->set_rules('domain', 'Domain', 'trim|valid_url|required');
        $this->form_validation->set_rules('user', 'User', 'trim');       

        $this->form_validation->set_error_delimiters('<li class="error-item"><i class="fa fa-times-circle" aria-hidden="true"></i> ','</li>');

        return $this->form_validation->run();
  	}

    protected function _api_key_generator(){
      $x = $this->input->post('domain');
      $key = implode('-', str_split(substr(strtolower(md5($x.microtime().rand(1000, 9999))), 0, 30), 6));
      return $key;
    }
  	
  	public function add(){
  		if (!$this->isLoggedIn() ){
        redirect('admin/users/login');
      }
      if(!$this->isUserAllowed('administrator') ){             
        //redirect('admin/main/unauthorized');            
        show_error('unauthorized');
      }

  		if($this->input->post('action') == 'add_api'){
    		if($this->_is_data_valid()){
            $api = array(
              'Key' => $this->_api_key_generator(),              
              'Domain' 			=> 		$this->input->post('domain'),
              'UserID'		=> 		$this->input->post('user'),					
              'status' => 1,
  				  ); 
  				
  				  if( $ApiID = $this->api_m->insert($api) ){
              $this->generateMessage('success','API generated for domain'.$api['Domain']);
              redirect('admin/api');
            }
  			}  		
  		}
  		$this->render('admin/api/add','admin_master');	
  	}
  	
    public function delete($id=0){  		
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    

        if (!$this->isUserAllowed('administrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }

        if(!$this->api_m->get($id)){
  			 $this->generateMessage('warning','API ID '.$id.' does not exist');
  			 redirect('admin/api');
  		  }
		
  		
		
  		if( $this->api_m->delete($id) ){
  			$this->generateMessage('success',"API Key deleted.");    		
  		}else{
  			$this->generateMessage('danger',"Couldn't delete API Key.");    		
  		}
  		$this->render('admin/api/list','admin_master');
  	}

}
