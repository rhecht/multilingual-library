<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends Admin_Controller{	
  	function __construct()
  	{
    	parent::__construct();        
    	
    	$this->data['categories'] = $this->category_m->order_by('Category','ASC')->get_all();
  		$this->data['mediatypes'] = $this->mediatype_m->order_by('Media','ASC')->get_all();
  		$this->data['languages'] = $this->language_m->order_by('Language','ASC')->get_all();
  		$this->data['authors'] = $this->author_m->order_by('Name','ASC')->get_all();
		
  		
  	}

  	/*
		this controls how json is outputed for datatables
  	*/
  	function ajax_list(){                       
        $this->datatables->select('
        	ArticleID, 
        	Title, 
        	Publication, 
        	language.Language, 
        	URL, 
        	mediatype.Media, 
        	Size,  
        	PublicationYear,        	        	
          status');

    	$this->datatables->unset_column('status');    	
    	$this->datatables->from($this->article_m->_table);
    	

      $this->datatables->join('language', 'language.LanguageID = article.LanguageID', 'left');
      $this->datatables->join('mediatype', 'mediatype.MediaTypeID = article.MediaTypeID', 'left');    	
		// check deleted
		//(%1$s > NOW() OR %1$s IS NULL OR %1$s = \'0000-00-00 00:00:00\'
		
		/* it auto searches, no need for this
		if( !empty( $_POST['search']['value'] ) ){          
            $term = $_POST['search']['value'];                                  
            $searchQuery = "
            `Title` LIKE BINARY '%$term%' OR 
            `Publication` LIKE BINARY '%$term%' OR 
            `Language` LIKE BINARY '%$term%' OR 
            `MediaType` LIKE BINARY '%$term%'  OR 
            `URL` LIKE BINARY '%$term%'";
 
            //$this->datatables->where($searchQuery,null,false); 
            $this->datatables->where('Title',$term); 

            //$this->datatables->or_like('Language',$term);
            //$this->datatables->or_like('MediaType',$term);
            //$this->datatables->or_like('URL',$term);            
        }else{
        	//$this->datatables->where('company.deleted_at >',"NOW()");
        	//$this->datatables->or_where('company.deleted_at IS NULL',NULL);
        	//$this->datatables->or_where('company.deleted_at',"0000-00-00 00:00:00");
        	$this->datatables->where('status',1);
        }*/
		
    //if( empty( $_POST['search']['value'] ) ){
	 //$this->datatables->where('deleted_at >',"NOW()");
    $this->datatables->where('status',1);
	 //$this->datatables->or_where('deleted_at IS NULL',NULL);
	 //$this->datatables->or_where('deleted_at',"0000-00-00 00:00:00");
    //}

		$edit   ='<a href="'.site_url('admin/article/edit/$1').'" class="btn btn-info btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a> '; 
    $delete ='<a href="'.site_url('admin/article/delete/$1').'" onclick="return confirm(\''.lang('Confirm Delete').'\');" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>'; 



		$this->datatables->add_column('action', $edit.$delete, 'ArticleID');			
		echo $this->datatables->generate('json');
		//echo "/*" . $this->datatables->last_query() . "*/";       
       
  	} 

  	public function index(){
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    

        if (!$this->isUserAllowed('adminstrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }

  		$this->render('admin/article/list','admin_master');
  	}

  	protected function _is_data_valid(){
  		
  		$this->form_validation->reset_validation();                        
        
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('publication', 'Publication', 'trim');
        $this->form_validation->set_rules('url', 'Url', 'trim');
        $this->form_validation->set_rules('abstract', 'Abstract', 'trim');
        $this->form_validation->set_rules('keyword', 'Keyword', 'trim');
        $this->form_validation->set_rules('publicationyear', 'Publication Year', 'trim');
        $this->form_validation->set_rules('mediatype', 'Media Type', 'trim');
        $this->form_validation->set_rules('language', 'Language', 'trim');
        $this->form_validation->set_rules('size', 'File Size', 'trim');

        $this->form_validation->set_error_delimiters('<li class="error-item"><i class="fa fa-times-circle" aria-hidden="true"></i> ','</li>');

        return $this->form_validation->run();
  	}

  	protected function update_categories($ArticleID){
  		$categories = $this->input->post('categories');
  		// remove all categories assigned to article
  		$this->article_category_m->delete_by(array('ArticleID'=>$ArticleID));
  		if($categories){
        foreach($categories as $category){
    			// insert the category selected
    			$data = array(
    				'ArticleID' => $ArticleID,
    				'CategoryID' => $category,
    			);
    			$this->article_category_m->insert($data);
    		}
      }
  	}

  	protected function update_authors($ArticleID){
  		$authors = $this->input->post('authors');
  		// remove all authors assigned to article
  		if($authors){
        $this->article_author_m->delete_by(array('ArticleID'=>$ArticleID));
    		foreach($authors as $author){
    			// insert the category selected
    			$data = array(
    				'ArticleID' => $ArticleID,
    				'AuthorID' => $author,
    			);
    			$this->article_author_m->insert($data);
    		}
      }
  	}


  	public function add(){

  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    

        if (!$this->isUserAllowed('adminstrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }

  		

  		if($this->input->post('action') == 'add_article'){
  			if($this->_is_data_valid()){
  				$article = array(  					
					'Title'				=> 		$this->input->post('title'),
					'Publication'		=> 		$this->input->post('publication'),
					'Language'			=> 		$this->language_m->get($this->input->post('language'))->{'Language'.$this->language},
					'URL'				=> 		$this->input->post('url'),
					'MediaType'			=> 		$this->mediatype_m->get($this->input->post('mediatype'))->{'Media'.$this->language},
					'Abstract'			=> 		$this->input->post('abstract'),
					'Keywords'			=> 		$this->input->post('keyword'),
					'PublicationYear'	=> 		date("Y-m-d",strtotime($this->input->post('publicationyear'))),
					'Size'				=> 		$this->input->post('size'),
					'LanguageID'		=> 		$this->input->post('language'),
					'MediaTypeID'		=> 		$this->input->post('mediatype'),
					'status'			=> 		1,
					'date_added'		=> 		date("Y-m-d H:i:s"),
					'date_modified'		=> 		date("Y-m-d H:i:s"),
  				);


  				//print_r($article);
  				

  				if($articleID = $this->article_m->insert($article)){
  					$this->update_categories($articleID);
  					$this->update_authors($articleID);

  					$this->generateMessage('success','Article added successfully');
  					redirect('admin/article');
  				}
  			}  		
  		}

  		$this->render('admin/article/add','admin_master');	
  	}

  	public function edit($id=0){  		
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    

        if (!$this->isUserAllowed('adminstrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }
  		
  		if(empty($id)){redirect('admin/article');}

  		if(!$this->article_m->get($id)){
  			$this->generateMessage('warning','Article ID '.$id.' does not exist');
  			redirect('admin/article');
  		}

  		if($this->input->post('action') == 'edit_article'){
  			if($this->_is_data_valid()){
				$article = array(  					
					'Title'				=> 		$this->input->post('title'),
					'Publication'		=> 		$this->input->post('publication'),
					'Language'			=> 		$this->language_m->get($this->input->post('language'))->{'Language'.$this->language},
					'URL'				=> 		$this->input->post('url'),
					'MediaType'			=> 		$this->mediatype_m->get($this->input->post('mediatype'))->{'Media'.$this->language},
					'Abstract'			=> 		$this->input->post('abstract'),
					'Keywords'			=> 		$this->input->post('keyword'),
					'PublicationYear'	=> 		date("Y-m-d",strtotime($this->input->post('publicationyear'))),
					'Size'				=> 		$this->input->post('size'),
					'LanguageID'		=> 		$this->input->post('language'),
					'MediaTypeID'		=> 		$this->input->post('mediatype'),
					'status'			=> 		1,
					//'deleted_at'		=> 		NULL,
					'date_modified'		=> 		date("Y-m-d H:i:s"),
				);

				if($this->article_m->update($id,$article)){
					
					$this->update_categories($id);
  					$this->update_authors($id);

					$this->generateMessage('success','Article added updated');
					redirect('admin/article/edit/'.$id);
					exit();
				}
			}
		}
		$this->data['record'] = $this->article_m->get($id);
  		$this->render('admin/article/edit','admin_master');	
  	}

  	public function delete($id=0){  		
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    

        if (!$this->isUserAllowed('adminstrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }

  		if(!empty($id)){
  			$update = array(
          'status' => 0,
          'date_modified' => date("Y-m-d H:i:s"),
        );

        if( $this->article_m->update($id,$update) ){
        //if( $this->article_m->delete($id) ){
  				$this->generateMessage('success',"Article deleted.");    		
  			}else{
  				$this->generateMessage('danger',"Couldn't delete article.");    		
  			}
  		}
  		//$this->render('admin/article/list','admin_master');
      redirect('admin/article');
  	}

  	public function upload(){
  		if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }    

        if (!$this->isUserAllowed('adminstrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }



        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|pdf|';
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;

        $this->load->library('upload', $config);					
		if ( $this->upload->do_upload('fileuploaded')){
			$x = $this->upload->data();

			$x['file_size'] = byte_format($x['file_size']);
			$x['file_name'] = base_url($config['upload_path'].$x['file_name']);

			echo json_encode($x);
		}else{
			echo json_encode(array('message'=>$this->upload->display_errors(),'error'=>'true'));
		}
		die();        
  	}


  	/*public function index($id=0)
  	{
		$config = array();
		$config["base_url"] = base_url() . "admin/articles";
		$config["total_rows"] = $this->article_m->record_count();
		$config["per_page"] = 20;
		$config["uri_segment"] = 3;

		$this->pagination->initialize($config);
	
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['records_header']=$this->article_m->get_col_names_view();
		$data['records']=$this->article_m->get_all_view($config["per_page"], $page);
		//print_r($data['records']);
	
		$data["links"] = $this->pagination->create_links();

		$data['keyid']=$this->articleModelID;

	
    	$this->load->view('admin/table_view', $data);
  	}*/

  public function single_post($id=0)
  {
				$data['records']=$this->article_m->get($id);

                $this->load->helper(array('form', 'url'));

                $this->load->library('form_validation');
				
				//TITLE	PUBLICATION	LANGUAGE	URL	MEDIATYPE	ABSTRACT	KEYWORDS	PUBLICATIONYEAR	SIZE	LANGUAGEID	MEDIATYPEID	STATUS

				$config = array(
						array(
								'field' => 'TITLE',
								'label' => 'TITLE',
								'rules' => 'required'
						),
						array(
								'field' => 'PUBLICATION',
								'label' => 'PUBLICATION',
								'rules' => 'required'
						),
						array(
								'field' => 'LANGUAGE',
								'label' => 'LANGUAGE',
								'rules' => 'required'
						),
						array(
								'field' => 'URL',
								'label' => 'URL',
								'rules' => 'required'
						),
						array(
								'field' => 'MEDIATYPE',
								'label' => 'MEDIATYPE',
								'rules' => 'required'
						),
						array(
								'field' => 'ABSTRACT',
								'label' => 'ABSTRACT',
								'rules' => 'required'
						),
						array(
								'field' => 'KEYWORDS',
								'label' => 'KEYWORDS',
								'rules' => 'required'
						),
						array(
								'field' => 'PUBLICATIONYEAR',
								'label' => 'PUBLICATIONYEAR',
								'rules' => 'required'
						),
						array(
								'field' => 'SIZE',
								'label' => 'SIZE',
								'rules' => 'required'
						),
						array(
								'field' => 'LANGUAGEID',
								'label' => 'LANGUAGEID',
								'rules' => 'required'
						),
						array(
								'field' => 'MEDIATYPEID',
								'label' => 'MEDIATYPEID',
								'rules' => 'required'
						),
						array(
								'field' => 'STATUS',
								'label' => 'STATUS',
								'rules' => 'required'
						)
				);
				
				$this->form_validation->set_rules($config);
				
				$data['keyid']=$this->articleModelID;
				$data['formsubmit']='admin/article/' . $data['records']->ArticleID;



	//author list key

	$data['DDList'][0]['idkey']=$this->Author_model->idKey;
	$data['DDList'][0]['allrecords']=$this->Author_model->get_all_unfiltered();
	$data['DDList'][0]['inputtype']="multiselect";
	$data['DDList'][0]['allrecordsselected']=$this->Articletoauthor_model->get_all_unfiltered();
	$data['DDList'][0]['specificrecordsselected']=$this->Articletoauthor_model->getByArticle($id);
	$data['DDList'][0]['namekey']=$this->Author_model->nameKey;

	$data['DDList'][1]['idkey']=$this->Category_model->idKey;
	$data['DDList'][1]['allrecords']=$this->Category_model->get_all_unfiltered();
	$data['DDList'][1]['inputtype']="multiselect";
	$data['DDList'][1]['allrecordsselected']=$this->Articletocategory_model->get_all_unfiltered();
	$data['DDList'][1]['specificrecordsselected']=$this->Articletocategory_model->getByArticle($id);
	$data['DDList'][1]['namekey']=$this->Category_model->nameKey;
	

	$data['DDList'][2]['idkey']=$this->Language_model->idKey;
	$data['DDList'][2]['allrecords']=$this->Language_model->get_all_unfiltered();
	$data['DDList'][2]['inputtype']="select";
	$data['DDList'][2]['allrecordsselected']="";
	$data['DDList'][2]['specificrecordsselected']="";
	$data['DDList'][2]['namekey']=$this->Language_model->nameKey;

	
	$data['DDList'][3]['idkey']=$this->Mediatype_model->idKey;
	$data['DDList'][3]['allrecords']=$this->Mediatype_model->get_all_unfiltered();
	$data['DDList'][3]['inputtype']="select";
	$data['DDList'][3]['allrecordsselected']="";
	$data['DDList'][3]['specificrecordsselected']="";
	$data['DDList'][3]['namekey']=$this->Mediatype_model->nameKey;
	
	$data['onetomanyitems']=array(0, 1); //this is for multiselects
	
	
	
                if ($this->form_validation->run() == FALSE)
                {
					$data['err']='Please correct the following errors.';
                        $this->load->view('admin/form_view',$data);
                }
                else
                {
						$data['err']='Form entry successfully submitted.';
                        //$this->load->view('formsuccess');
                }

  }


}