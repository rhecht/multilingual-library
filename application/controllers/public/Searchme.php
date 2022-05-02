<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Searchme extends Public_Controller {

  function __construct()
  {
    parent::__construct();
        $this->load->helper("url");
        $this->load->model("Article_model");
		$this->load->helper('xml');
		$this->load->helper('text');
  }


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//load language file(s) here somewhere
		//$this->lang->load('filename', 'language');
		$this->lang->load('somefile.php', 'hebrew');
		$this->load->view('welcome_message');
	}
	public function rss()
	{
		$data['records']=$this->Article_model->get_all_unfiltered();

//		print_r($data['records']);
		
		$this->load->view('main/rss', $data);
	}
	public function json()
	{
		$data['records']=$this->Article_model->get_all_unfiltered();
		$this->load->view('main/json', $data);
	}
	public function lang(){
	}
}
