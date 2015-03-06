<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {
    public function __construct() {
        parent::__construct();
        parent::default_meta();
        
        $this->data->metadata = $this->template->get_metadata();
    }
    
    public function index() {
        $this->data->word = 'Admin';
        parent::_view('page',$this->data);
    }
    
    public function logout() {
        $this->autentifikasi->logout();
        redirect (site_url());
    }
    
}
?>