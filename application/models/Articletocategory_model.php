<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Articletocategory_model extends MY_Model {

    public $_table = 'articletocategory';    
    public $primary_key = 'id';   

    //
    
    //public $belongs_to = array( 'category_m' => array( 'primary_key' => 'CategoryID' ) );
    //public $has_many = array( 'comments' => array( 'primary_key' => 'parent_post_id' ) );
}