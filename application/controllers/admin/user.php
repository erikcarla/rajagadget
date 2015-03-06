<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {
    private $judul = 'User';
    
    private $rules = array (
                        array(
                                 'field'   => 'username', 
                                 'label'   => 'Username', 
                                 'rules'   => 'alpha_numeric|required|max_length[15]|min_length[6]'
                              ),
                        array(
                                 'field'   => 'email', 
                                 'label'   => 'Email', 
                                 'rules'   => 'valid_email|required'
                              ),
                        array(
                                 'field'   => 'password', 
                                 'label'   => 'Password', 
                                 'rules'   => 'alpha_numeric|required|max_length[20]|min_length[6]'
                              ),
                        array(
                                 'field'   => 'conf_password', 
                                 'label'   => 'Confirm Password', 
                                 'rules'   => 'alpha_numeric|required|max_length[20]|matches[password]'
                              )
                         );
    private $edit_rules = array (
                        array(
                                 'field'   => 'username', 
                                 'label'   => 'Username', 
                                 'rules'   => 'alpha_numeric|required|max_length[15]|min_length[6]'
                              ),
                        array(
                                 'field'   => 'email', 
                                 'label'   => 'Email', 
                                 'rules'   => 'valid_email|required'
                              ),
                        array(
                                 'field'   => 'new_password', 
                                 'label'   => 'Password Baru', 
                                 'rules'   => 'alpha_numeric|required|max_length[20]|min_length[6]'
                              ),
                        array(
                                 'field'   => 'conf_password', 
                                 'label'   => 'Confirm Password', 
                                 'rules'   => 'alpha_numeric|required|max_length[20]|matches[new_password]'
                              )
                         );
    private $login_rules = array (
                        array(
                                 'field'   => 'username', 
                                 'label'   => 'Username', 
                                 'rules'   => 'alpha_numeric|required|max_length[15]|min_length[6]'
                              ),
                        array(
                                 'field'   => 'password', 
                                 'label'   => 'Password', 
                                 'rules'   => 'alpha_numeric|required|max_length[20]|min_length[6]'
                              )
                         );
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
        parent::set_judul($this->judul);
        parent::default_meta();
        $this->load->model('user_m');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="msg warning">', '</p>');
        
        $this->data->metadata = $this->template->get_metadata();
        $this->data->judul = $this->template->get_judul();
    }
    
    public function index(){
        $this->data->user = $this->user_m->get_all();
        
        parent::_view('user/list',$this->data);
    }
    
    public function tambah() {
        $this->form_validation->set_rules($this->rules);
        if($this->form_validation->run()) {
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $level = $this->input->post('level');
            
            if(!$this->autentifikasi->tambah($username,$email,$password,$level)) {
                $this->data->error = '<div class="error">Username telah digunakan</div>';
            } else {
                $this->data->sukses = '<div class="sukses">Proses registrasi berhasil</div>';
            }
        }
        
        $this->data->username = set_value('username');
        $this->data->email = set_value('email');
                
        parent::_modal('user/form_register',$this->data);
    }
    
    public function profile($id = 0) {
        $this->load->model('profile_m');
        
        $data = $this->profile_m->get_by(array('user_id'=>$id));
        
        $this->form_validation->set_rules($this->profile_rules);
        if($this->form_validation->run()) {
            $insert = array(    'nama'    =>  $this->input->post('nama'),
                                'alamat'        =>  $this->input->post('alamat'),
                                'kode_pos'      =>  $this->input->post('kode_pos'),
                                'phone'         =>  $this->input->post('phone'));
            if($data){
                if($this->profile_m->update($data->id_user_data,$insert)){
                    $this->data->sukses = '<div class="sukses">profile berhasil diperbaharui </div>';
                }
            }else{
                $insert['user_id'] = $id;
                if($this->profile_m->insert($insert)){
                    $this->data->sukses = '<div class="sukses">Profile berhasil diisikan</div>';
                }
            }
        }
        
        if($data){
            $this->data->nama = $data->nama;
            $this->data->alamat = $data->alamat;
            $this->data->kode_pos = $data->kode_pos;
            $this->data->phone = $data->phone;
        }else{
            $this->data->nama = set_value('nama');
            $this->data->alamat = set_value('alamat');
            $this->data->kode_pos = set_value('kode_pos');
            $this->data->phone = set_value('phone');    
        }
        
        parent::_modal('user/form_profile',$this->data);
    }
    
    public function ubah($id = 0) {
        $data = $this->user_m->get($id);
        
        $this->form_validation->set_rules($this->edit_rules);
        if($this->form_validation->run()) {
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $password = $this->input->post('new_password');
            $level = $this->input->post('level');
            
            if(!$this->autentifikasi->ubah($id,$username,$email,$password,$level)) {
                $this->data->error = '<div class="error">Username telah digunakan</div>';
            } else {
                $this->data->sukses = '<div class="sukses">Proses registrasi berhasil</div>';
            }
        }
        
        if($data){
            $this->data->username = $data->username;
            $this->data->email = $data->email;
            $this->data->level = $data->level;
        }else{
            $this->data->username = set_value('username');
            $this->data->email = set_value('email');
            $this->data->level = set_value('level');
        }
        
        parent::_modal('user/form_edit',$this->data);
    }
    
    public function record($id = 0) {
        $this->load->model('order_m');
        $this->load->model('profile_m');
        
        $this->data->profile = $this->profile_m->get_by(array('user_id'=>$id));
        
        $this->data->order = $this->order_m->get_record(array('user_id'=>$id));
        
        parent::_view('user/record',$this->data);
    }
    
    public function detail($id = 0) {
        $this->load->model('order_m');
        if ($this->input->post('submit')){
            $this->order_m->update_by(array('id_order'=>$id),array('status_order'=>$this->input->post('status')));
            $this->data->sukses = 'Data berhasil diperbaharui';   
        } else {
            $this->data->detail = $this->order_m->get_record(array('id_order'=>$id),true);
        }
        
        parent::_modal('laporan/detail',$this->data);
    }
    
    public function hapus($id = 0) {
        $id OR redirect(site_url('admin/user'));
        
        if($this->session->userdata('user_id') != $id){
            $this->user_m->hapus($id);   
        } else {
            $this->session->set_flashdata('user_note','<p class="msg warning">Anda tidak diperkenankan menghapus diri anda sendiri.</p>');        
        }
        
        redirect(site_url('admin/user'));
    }
    
    public function aktifasi($id = 0, $aktif = 0) {
        $id OR redirect(site_url('admin/user'));
        
        if($this->session->userdata('user_id') != $id){
            $this->user_m->update($id,array('status'=>$aktif));
        }else{
            $this->session->set_flashdata('user_note','<p class="msg warning">Anda tidak diperkenankan menonaktifkan diri anda sendiri.</p>');
        }
        
        redirect(site_url('admin/user'));
    }
}