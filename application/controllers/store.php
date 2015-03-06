<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends CI_Controller {
    private $profile_rules = array (
                        array(
                                 'field'   => 'nama', 
                                 'label'   => 'Nama', 
                                 'rules'   => 'alpha|required'
                              ),
                        array(
                                 'field'   => 'alamat', 
                                 'label'   => 'Alamat', 
                                 'rules'   => 'utf8|required|max_length[200]'
                              ),
                        array(
                                 'field'   => 'phone', 
                                 'label'   => 'Telephone', 
                                 'rules'   => 'numeric'
                              ),
                        array(
                                 'field'   => 'kode_pos', 
                                 'label'   => 'Kode Pos', 
                                 'rules'   => 'numeric'
                              )
                         );
    
    public function __construct() {
        parent::__construct();
        
        
        $this->template->set_template('template');
        $this->template->set_css(array('store'));
        $this->load->model('kategori_m');
        $this->load->model('produk_m');
                
        $this->data->kategori = $this->kategori_m->kategori_menu_list;
        $this->data->cart = $this->cart->contents();
        
        $is_active = $this->autentifikasi->sudah_login();
        $is_allow = $this->autentifikasi->role(array('user','admin'));
        $this->data->logged_in = $is_active && $is_allow;
    }
    
    public function index(){
        $this->template->set_judul('Raja Gadget')
        ->set_css('style')
		->set_js('jquery')
		->set_js('content')
		->set_js('jquery-easing')
        ->set_parsial('sidebar','sidebar_view',$this->data)
        ->set_parsial('topmenu','top_view',$this->data)
        ->render('front',$this->data);   
    }
    
    public function kategori($url = null){
        $url or redirect(site_url());
        
        $this->data->produk = $this->produk_m->get_all_produk($url);
        
        $this->template->set_judul('Raja Gadget')
        ->set_css('style')
		->set_js('jquery')
		->set_js('content')
		->set_js('jquery-easing')
        ->set_parsial('sidebar','sidebar_view',$this->data)
        ->set_parsial('topmenu','top_view',$this->data)
        ->render('store',$this->data);   
    }
    
    public function produk($url = null){
        $url or redirect(site_url());
        
        if(!$this->data->produk = $this->produk_m->get_by_url($url)){
            redirect (site_url('store'));
        }
                        
        //$this->load->view('store',$data);
        $this->template->set_judul('Raja Gadget')
        ->set_css('style')
		->set_js('jquery')
		->set_js('content')
		->set_js('easySlider1.7')
        ->set_parsial('sidebar','sidebar_view',$this->data)
        ->set_parsial('topmenu','top_view',$this->data)
        ->render('single',$this->data);   
    }
    
    public function add_cart() {
        $data = array ( 'id'=>$this->input->post('id'),
                        'name'=>$this->input->post('name'),
                        'qty'=>$this->input->post('qty'),
                        'price'=>$this->input->post('price'),
                        'kode'=>$this->input->post('kode')
                        );
        $this->cart->insert($data);
        redirect (site_url($this->input->post('url')));
    }
    
    public function hapus_cart() {
        $this->cart->destroy();
        redirect (site_url());
    }
    
    public function checkout() {
        if($_POST) {
            $this->cart->update($_POST);   
        }
        
        $this->template->set_judul('Raja Gadget')
        ->set_css('style')
		->set_js('jquery')
		->set_js('content')
		->set_js('easySlider1.7')
        ->set_parsial('sidebar','sidebar_view',$this->data)
        ->set_parsial('topmenu','top_view',$this->data)
        ->render('checkout',$this->data); 
    }
    
    public function order() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->profile_rules);
        
        $this->load->model('profile_m');
        $this->load->model('order_m');
        
        $data = $this->profile_m->get_by(array('user_id'=>$this->session->userdata('user_id')));
        
        if($this->form_validation->run()) {
            $insert = array(    'nama'    =>  $this->input->post('nama'),
                                'alamat'        =>  $this->input->post('alamat'),
                                'kode_pos'      =>  $this->input->post('kode_pos'),
                                'phone'         =>  $this->input->post('phone'));
            
            $order = array(     'user_id'       =>  $this->session->userdata('user_id'),
                                'total_biaya'   =>  $this->cart->total(),
                                'total_item'    =>  $this->input->post('total_item'));
            if($data){
                if($this->profile_m->update($data->id_user_data,$insert)){
                    $this->order_m->insert($order,$this->cart->contents());
                    $this->cart->destroy();
                    
                    $this->session->set_flashdata('pesan', '<div class="sukses">Data pesanan telah kami terima</div>');
                    redirect(site_url('store/order'));
                }
            }else{
                $insert['user_id'] = $this->session->userdata('user_id');
                if($this->profile_m->insert($insert)){
                    $this->order_m->insert($order,$this->cart->contents());
                    $this->cart->destroy();
                    
                    $this->session->set_flashdata('pesan', '<div class="sukses">Data pesanan telah kami terima</div>');
                    redirect(site_url('store/order'));
                }
            }
        }
        
        if($data){
            $this->data->nama = $data->nama;
            $this->data->alamat = $data->alamat;
            $this->data->kode_pos = $data->kode_pos;
            $this->data->phone = $data->phone;
        }else{
            $this->data->nama= set_value('nama');
            $this->data->alamat = set_value('alamat');
            $this->data->kode_pos = set_value('kode_pos');
            $this->data->phone = set_value('phone');    
        }
        
        $this->template->set_judul('Raja Gadget')
        ->set_css('style')
		->set_js('jquery')
		->set_js('content')
		->set_js('easySlider1.7')
        ->set_parsial('sidebar','sidebar_view',$this->data)
        ->set_parsial('topmenu','top_view',$this->data)
        ->render('order',$this->data); 
    }
    
}

?>