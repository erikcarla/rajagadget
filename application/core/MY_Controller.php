<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    private $default_view ;
    private $judul = 'admin ' ;
    
    public function __construct(){
        parent::__construct();
        if (!$this->autentifikasi->sudah_login()) redirect (site_url('login'));
        if (!$this->autentifikasi->role(array('admin'))) redirect (site_url('login'));
        
        $this->default_view = $this->load->_ci_view_path;
        $this->load->_ci_view_path = $this->default_view.'admin/';
        
        $this->template->use_asset();
    }
    
    public function default_meta() {
        $this->template->set_css(array('reset','main','2col','style','mystyle','colorbox'))
        ->set_js(array('jquery','switcher','toggle','ui.core','ui.tabs','jquery.colorbox.min'))
        ->set_judul($this->judul);
        return $this;
    }
    
    public function set_judul($judul = '') {
        $this->judul = $this->judul.'| '.$judul;
        return $this;
    }
    
    protected function _view($view,$data) {
        $this->load->view('header',$data);
        $this->load->view('topmenu',$data);
        $this->load->view('sidebar',$data);
        $this->load->view($view,$data);
        $this->load->view('bottom',$data);
        $this->load->view('footer',$data);
    }
    
    protected function _modal($view,$data) {
        $this->load->view('header',$data);
        $this->load->view($view,$data);
        $this->load->view('footer',$data);
    }
}

?>