<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller {
	
    function __construct(){
		parent::__construct();          
	}

	public function index(){
        if (!$this->isLoggedIn() ){
            redirect('admin/users/login');
        }   

        if (!$this->isUserAllowed('administrator') ){             
            //redirect('admin/main/unauthorized');            
            show_error('unauthorized');
        }        

        $this->data['users'] = $this->user_m->get_all();        
        $this->render('admin/users/list','admin_master');
	}

    public function list(){
        $this->index();
    }

    public function reset_password(){
        
        $this->load->library('email');

        // check user/email if it exists
        if( $username = $this->input->post('email') ){            
            $user = $this->user_m->get_by('email',$username);
            
            if(!$user){
                $user = $this->user_m->get_by('name',$username);
            }

            //print_r($user);

            if(!$user){
                $this->generateMessage('warning',"Oops, you are not yet registered to our system");    
                redirect('admin/users/reset_password');
            }
            if($user){
                
                $new_password = generateRandomString(12);

                // send password to user's email
                $this->email->from('no-reply@tekhelet.com', 'Tekhelet');
                $this->email->to($user->email);
                
                $this->email->subject('Tekhelet Password Reset');
                $this->email->message('Please login in with your new password : '.$new_password);

                //echo $new_password;

                if( $this->email->send()){
                    $data = array(
                        'password' => $this->user_m->_encrypt($new_password),
                    );

                    //print_r($data);
                    //print_r($user);
                    //echo $new_password;

                    $this->user_m->update($user->id,$data);
                    $this->generateMessage('success',"We have generated a new password for you, please check your email");    
                     redirect('admin/users/login');
                }

                //echo $new_password;
            }
        }        
        $this->data['body_class'] = "auth-page height-auto bg-blue-600";
        $this->render('admin/users/forgot','admin_master');
    }

    public function login(){        
        
        if ( isset($_POST['login'])){
            // check if user exists
            $row = $this->user_m->get_by('email',$this->input->post('email'));
            if(!$row){
                $row = $this->user_m->get_by('name',$this->input->post('email'));                
            }
            $password = $this->input->post('password');

            if (!$row){
                $this->generateMessage('warning',"Oops, you are not yet registered to our system");                
            }else{
                // check if account is active
                if ($row->active == 0){
                    $this->generateMessage('warning',"Oops, your account is not yet activated.");     
                // check if passwords match

                //}elseif( $this->input->post('password') === $this->user_m->_decrypt($row->password) ){
                // using password_hash
                //}elseif( password_verify($password,$row->password)  ){ // can use password_verify / md5_hash
                }elseif(  
                    password_verify($password,$row->password) || 
                    md5($this->input->post('password')) === $row->password 
                ){
                    // good to go, login this user by setting the biSessionUser 
                    $sessionId = session_id();
                    $this->session->set_userdata('tekheletSessionUser', $sessionId);
                    
                    // set cookie as well
                    $cookie =array(
                      'name'   => 'tekheletSessionUser',
                      'value'  => $sessionId,        
                      'expire' => '86500', //24 hours
                    );
                    $this->input->set_cookie($cookie);                                      

                    // update user details
                    $loginUpdate = array(
                        'session_id'=>session_id(),
                        'ip_lastlogin'=>$_SERVER['REMOTE_ADDR'], 
                        'date_lastlogin' => date("Y-m-d h:i:s"),
                    );
                    $this->user_m->update($row->id,$loginUpdate);         
                    redirect('admin');
                }else{
                    $this->generateMessage('warning',"Oops, your email/password does not match.");  
                }
            }
        }                
        
        $this->data['body_class'] = "auth-page height-auto bg-blue-600";
        $this->render('admin/users/login','admin_master');

    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('admin/users/login'); 
    }

    /*
        handles all the validation rules
    */
    function __setValidationRules($userId=false){        
        $this->form_validation->reset_validation();                        
        if(!$userId){ 
            $this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[users.name]');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[users.email]|required');  
            $this->form_validation->set_rules('password', 'Password', 'trim|required');  
        }else{ // if userId exists, it means its editing user                       
            $this->form_validation->set_rules('name', 'Name', 'trim|required|edit_unique[users.name.'.$userId.']');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|edit_unique[users.email.'.$userId.']|required');              
        }                
        
        $this->form_validation->set_rules('isActive', 'Is Active', 'trim');      
        $this->form_validation->set_rules('isAdmin', 'Admin', 'trim');       
        foreach($this->roles as $role){           
            $this->form_validation->set_rules($role->name, ucwords($role->description), 'trim');
        }
        // for password only
        if(isset($_POST['changePassword'])){  
            $this->form_validation->reset_validation();            
            $this->form_validation->set_rules('newPass', 'New Password', 'trim|required');  
            $this->form_validation->set_rules('newPassCheck', 'Confirm Password', 'trim|required|matches[newPass]');  
        }
        //$this->form_validation->set_error_delimiters('<p class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><i class="fa fa-times-circle" aria-hidden="true"></i> ','</p>');     
        $this->form_validation->set_error_delimiters('<li class="error-item"><i class="fa fa-times-circle" aria-hidden="true"></i> ','</li>');        
    }

    public function __setPostData(){
        $data = array(
            'name' => $this->input->post('name'),
            'email' =>$this->input->post('email'),
            'password' => $this->user_m->_encrypt($this->input->post('password')),
            'active' => $this->input->post('isActive'),                    
            //'is_admin' => $this->input->post('isAdmin')?'1':'0',
        );
        return $data;
    }

    public function __updateUserPermissions($userId){
        // get permissions from input
        if( $this->user->is_admin ){ // admin only function
            $permissions = array();
            foreach($this->roles as $role){
                if($this->input->post($role->name)){
                    $permissions[] = array(
                        'user_id' => $userId,
                        'role_id' => $this->input->post($role->name),
                    );                
                }            
            }        
            $this->access_m->delete_by('user_id',$userId);
            if ($userId && $permissions){
                // remove all permission from users first            
                $this->access_m->insert_many($permissions);
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
        
        if(isset($_POST['add'])){            
            // prepare validation
            $this->__setValidationRules();
            if($this->form_validation->run()) {                                          
                $insert = $this->__setPostData();                
               

                if( $newUserId = $this->user_m->insert($insert) ){
                    // update by admin only                    
                    $this->__updateUserPermissions($newUserId);                                        
                    $this->generateMessage('success',"User - [" . $insert['name'] . "] successfully added.");
                    redirect('admin/users/list');
                }                
            }
        }                  
        
        $this->render('admin/users/add','admin_master');
    }

    function profile(){
        $this->details($this->user->id);
    }

    /*
        view and edit user
    */
    function details($userId){		
        if(empty($userId)){redirect('admin/users');}        
        /*using this instead of *, for performance improvements later on*/
        
        if(isset($_POST['discard'])){                  
            redirect('admin/users');
        }
        // check if user is admin, and if not, check if user owns the id
        if ( !$this->user->is_admin ){
            if ($this->user->id != $userId){                
                redirect('admin/users/profile');
            }
        }

        $check = $this->user_m->get($userId);
        if (!$check){
            $this->generateMessage('warning',"User ID not on record");
            redirect('admin/users');
        }   

        $this->__setValidationRules($userId);
        
        if(isset($_POST['update'])){              
            if($this->form_validation->run()) {                                             
                $update = $this->__setPostData();
                                
                unset($update['password']); // unset password since we have different flow for that
                if( $this->user_m->update($userId, $update)){                   
                    $this->__updateUserPermissions($userId);                         
                    $this->generateMessage('success',"Information for [" . $check->name . "] successfully updated.");
                    if ($this->user->is_admin){
                        redirect('admin/users/list');
                    }else{
                        redirect(current_url());
                    }
                }                
            }
		}		
        if(isset($_POST['changePassword'])){                                          
            if($this->form_validation->run()) {                
                $update = $this->__setPostData();               
                if( $this->user_m->update($userId,array('password'=> $this->user_m->_encrypt($this->input->post('newPass')) )) ){
                    $this->generateMessage('success',"Password for [" . $check->name . "] successfully updated.");
                    if ($this->user->is_admin){
                        redirect('admin/users/list');
                    }else{
                        redirect(current_url());
                    }
                }
            }            
		}       

        $this->data['row'] = $this->user_m->cols('id,name,email,active,is_admin')->get($userId);
        $this->template='main/users/edit';

        $this->render('admin/users/edit','admin_master');
	}

    /*This uses inline editing, proceed with caution and verify all data coming in*/
    private function pre_update(){
        // check for validity
        $column= $this->input->post('name');
        $userId = $this->input->post('pk');
        $value = $this->input->post('value');
        //email
        // check if email already exists
        $flag = true; // it will be changed to an error message

        switch ($column){
           case 'email' : 
                if ( $check = $this->user_m->get_by(array('email'=>$value)) ){
                    if( $check->id != $userId ){ // owned by another
                        $flag = 'Email already exists';
                    }
                }
           break; 
        }
        
        return $flag;
    }

    function update(){
        /*
        [name] => name    [value] => asdf    [pk] => 1
        */

        $column= $this->input->post('name');
        $userId = $this->input->post('pk');
        $value = $this->input->post('value');

        //print_r($this->user);
        //print_r($_POST);

        $response = array();

        // verify if user is admin or has rights
        if ($this->user){
            if ($this->user->is_admin || ( $this->user->id == $userId) ){
                
                $update = array(
                    $column => $value,
                );
                $flag = $this->pre_update();
                // update data                
                if($flag === true){
                    if ( $this->user_m->update($userId,$update) ){
                        $response['status'] = 'success';
                        $response['general_message'] = 'Successfully updated field';
                    }else{
                        $response['status'] = 'error';
                        $response['general_message'] = 'Error updating field '. $column;
                    }
                }else{                
                    $response['status'] = 'error';
                    $response['general_message'] = $flag;
                }
            }
        }

        header('Content-type: application/json');
        echo json_encode($response);
    }

    function update_permissions(){        
        $userId = $this->input->post('pk');
        $permissions = $this->input->post('value');        
        $response = array();

        if ($this->user && $this->user->is_admin){            
            $this->access_m->delete_by('user_id',$userId);            
            if ($userId && $permissions){
                // remove all permission from users first            
                foreach($permissions as $permit){                    
                    $query[] = array(
                        'user_id' => $userId,
                        'role_id' => $permit,
                    );                    
                }
                $this->access_m->insert_many($query);
            }
            // nothing can go wrong i hope
            $response['status'] = 'success';
            $response['general_message'] = 'Permissions updated';
        }else{
            $response['status'] = 'error';
            $response['general_message'] = 'Not allowed to change permissions';
        }        

        header('Content-type: application/json');
        echo json_encode($response); 
    }

    function json_get_permissions(){       
        $response = array();
        $roles = $this->roles_m->get_all();
        foreach($roles as $role){
            $response[] = array('value' => $role->id, 'text' => $role->name);
        }
        header('Content-type: application/json');
        echo json_encode($response);

    }
}