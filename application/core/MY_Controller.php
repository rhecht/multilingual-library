<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
    This is global controller, it shares function for both public and admin
*/
class MY_Controller extends CI_Controller{

  protected $data = array();
  public $user;  
  public $roles;

  public $message;
  public $message_type;

  public $language;
  public $languageCode;
  public $idiom;
  
  function __construct(){    
    parent::__construct();
    $this->data['page_title'] = 'CI App';
    $this->data['before_head'] = '';
    $this->data['before_body'] ='';
    $this->data['body_class'] = '';

    // load libraries
    $this->load->library("pagination");
    $this->load->library('form_validation');
    $this->load->library('my_form_validation');

    // load helpers
    $this->load->helper("url");
    $this->load->helper("form");  
    $this->load->helper("general");  
    $this->load->helper('number');
    $this->load->helper('language');
    $this->load->helper('text');
    $this->load->helper('xml');

    // models will be loaded on admin/public controllers     
    $this->load->model("User_model", 'user_m'); 
    $this->load->model("Access_model", 'access_m');
    $this->load->model("Roles_model", 'roles_m'); 

    $this->load->model("Api_model",'api_m');

    

    $this->roles = $this->roles_m->get_all();  
           
    // set data
    $this->user = $this->isLoggedIn(); 

    $this->set_language();

    $this->lang->load('general', $this->idiom);
    
  }  

  protected function set_language(){
    $this->language = '';

    if(isset($_GET['lang'])){      
      switch($_GET['lang']){        
        case 'he' : $lang = '_he';  $this->idiom='hebrew';  $this->languageCode="he"; break;
        case 'en' : $lang = NULL;   $this->idiom='english'; $this->languageCode="en"; break;
        case 'es' : $lang = NULL;   $this->idiom='spanish'; $this->languageCode="es"; break;
        case 'fr' : $lang = NULL;   $this->idiom='french'; $this->languageCode="fr"; break;
        case 'ru' : $lang = NULL;   $this->idiom='russian'; $this->languageCode="ru"; break;
        default   : $lang = NULL;   $this->idiom='english'; $this->languageCode="en"; break;
      }
      // set the language
      $this->language = $lang;    
    }        
  }

  protected function render($the_view = NULL, $template = 'master'){
    $this->getGeneratedMessage();

    if($template == 'json' || $this->input->is_ajax_request())
    {
      header('Content-Type: application/json');
      echo json_encode($this->data);
    }
    else
    {
      $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view,$this->data, TRUE);
      $this->load->view('templates/'.$template.'_view', $this->data);
    }
  }

  function generateMessage($type,$message){
    $this->session->set_userdata('message_type', $type);
    $this->session->set_userdata('message', $message);
  }

  function getGeneratedMessage(){
    // get message and message type if any
    $this->message = $this->session->userdata('message');
    $this->message_type = $this->session->userdata('message_type');
    //$this->message_icons = $this->config->item('message_type_icons');

    // destroy after getting
    $this->session->unset_userdata('message_type');
    $this->session->unset_userdata('message');
  }

  function isLoggedIn(){
    // get session id of user     
    $user = $this->user_m->is_logged_in();
    if($user){
      $this->user = $user;
    }else{
      $this->user = false;
    }
    return $this->user;
  }
  
  // used for controller, check general helper for the template one
  function isUserAllowed(){
    
    return true;
    // full access for admin
    if ($this->user->is_admin){
      return true;
    }

    $restrictions = func_get_args();
    $permissions = $this->user->allowed_access;
    
    if(!$permissions){
      return false;
    }

    $access = 0;
    // check all users permission if it has access to restrictions
    
    foreach($permissions as $permission){
      if( in_array($permission,$restrictions) ){
        $access++;
      }
    }   

    // number of restriction matches number of allowed  
    if($access == count($restrictions)){      
      return true;
    }else{
      return false;
    }
    
  }


}/*end MY_Controller*/

include_once "Admin_Controller.php";
include_once "Public_Controller.php";