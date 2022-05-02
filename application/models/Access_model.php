<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Access_model extends MY_Model{	

	public $_table = 'users_access';	
	public $primary_key = "id";	

	public $belongs_to = array( 
		'roles' => array( 'model' => 'Roles_model', 'primary_key'=>'role_id' ),
		'user' => array( 'model' => 'User_model', 'primary_key'=>'user_id' ) 
	);
    
    function prepare_data($row){
    	return $row;
    }

	function get_allowed($id,$return_id=false){					
		$allowed = array();
		$result = $this->with('roles')->get_many_by('user_id',$id);
		if($result){
			foreach ( $result as $row ){
				if($return_id){
					$allowed[] = $row->roles->id;
				}else{					
					$allowed[] = $row->roles->name;
				}
			}
		}
		if(count($allowed)){
			return $allowed;
		}else{
			return 0;
		}	
	}

}