<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Roles_model extends MY_Model{	

	public $_table = 'users_roles';	
	public $primary_key = 'id';	
	protected $deleted_at_key = 'deleted_at'; 
}
