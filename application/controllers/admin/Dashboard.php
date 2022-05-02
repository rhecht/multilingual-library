<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller{

  function __construct(){
    parent::__construct();
  }

  public function index(){
    if (!$this->isLoggedIn() ){
    	redirect('admin/users/login');
    }   
    $this->render('admin/dashboard_view','admin_master');
  }
}