<?php

defined('BASEPATH') OR exit('No direct script access allowed');	

class User_model extends MY_Model{	



	public $_table = 'users';	
	public $primary_key = 'id'; 	
	protected $deleted_at_key = 'deleted_at';	
	protected $after_get = array('get_roles');



	function get_roles($row){
		if(!empty($row->id)){
			$row->allowed_access = $this->access_m->get_allowed($row->id);
			$row->allowed_roles_ids = $this->access_m->get_allowed($row->id,true);
			//$row->access = $this->access_m->with('roles')->get_many_by('user_id',$row->id);
		}
		return $row;
	}



	function is_logged_in(){
		$userId = $this->session->userdata('tekheletSessionUser');	
		if($userId){
			$row = $this->cols('id,name,email,is_admin')->get_by( array('session_id'=> $userId) );
			if($row){
				return $row;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}	
} 