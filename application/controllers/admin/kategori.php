<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori extends MY_Controller {
    private $judul = 'Kategori';
    private $rules = array (
                        array(
                                 'field'   => 'kode', 
                                 'label'   => 'Kode', 
                                 'rules'   => 'utf8'
                              ),
                        array(
                                 'field'   => 'deskripsi', 
                                 'label'   => 'Deskripsi', 
                                 'rules'   => 'utf8'
                              ),
                        array(
                                 'field'   => 'kategori', 
                                 'label'   => 'Nama Kategori', 
                                 'rules'   => 'required|utf8'
                              )
                         );
    
    public function __construct() {
        parent::__construct();
        parent::set_judul($this->judul);
        parent::default_meta();
        $this->load->model('kategori_m');
        
        $this->data->metadata = $this->template->get_metadata();
        $this->data->judul = $this->template->get_judul();
    }
    
    public function index(){
        $this->data->kategori = $this->kategori_m->kategori;
        
        parent::_view('kategori/list',$this->data);
    }
    
    public function tambah() {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="msg warning">', '</p>');
        
        $this->data->list_kategori['0'] = 'No Parent';
        foreach($this->kategori_m->kategori as $key => $val) {
            $this->data->list_kategori[$val['id_kategori']] = $val['nama_kategori'];
        }
        
        $this->form_validation->set_rules($this->rules);
        
        if($this->form_validation->run()) {
            $data =  array (    'nama_kategori' =>  $this->input->post('kategori'),
                                'url'           =>  underscore($this->input->post('kategori')),
                                'kode_kategori' =>  $this->input->post('kode'),
                                'parent'        =>  $this->input->post('parent'),
                                'deskripsi'     =>  $this->input->post('deskripsi')
                            );
            if ($this->kategori_m->insert($data)) {
                $this->data->sukses = 'Data Berhasil di tambahkan';
            }
        }
        
        $this->data->kategori = set_value('kategori');
        $this->data->kode = set_value('kode');
        $this->data->deskripsi = set_value('deskripsi');
        $this->data->parent = $this->input->post('parent');
                
        parent::_modal('kategori/form',$this->data);
    }
    
    public function ubah($id = 0) {
        $id OR redirect(site_url('admin/kategori'));
        
        $data_lama = $this->kategori_m->get($id);
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="msg warning">', '</p>');
        
        $this->data->list_kategori['0'] = 'No Parent';
        foreach($this->kategori_m->kategori as $key => $val) {
            if($val['id_kategori'] == $id){
                continue;
            }
            $this->data->list_kategori[$val['id_kategori']] = $val['nama_kategori'];
        }
        
        $this->form_validation->set_rules($this->rules);
        
        if($this->form_validation->run()) {
            $data =  array (    'nama_kategori' =>  $this->input->post('kategori'),
                                'url'           =>  underscore($this->input->post('kategori')),
                                'kode_kategori' =>  $this->input->post('kode'),
                                'parent'        =>  $this->input->post('parent'),
                                'deskripsi'     =>  $this->input->post('deskripsi')
                            );
            if ($this->kategori_m->update($id,$data)){
                $this->data->sukses = 'Data Berhasil di perbaharui';
            }
        } 
        
        if(!$this->input->post('submit')){
            $this->data->kategori = $data_lama->nama_kategori;
            $this->data->kode = $data_lama->kode_kategori;
            $this->data->deskripsi = $data_lama->deskripsi;
            $this->data->parent = $data_lama->parent;
        } else {
            $this->data->kategori = set_value('kategori');
            $this->data->kode = set_value('kode');
            $this->data->deskripsi = set_value('deskripsi');
            $this->data->parent = $this->input->post('parent');
        }                
        parent::_modal('kategori/form',$this->data);
    }
    
    public function hapus($id = 0) {
        $id OR redirect(site_url('admin/kategori'));
        
        $this->kategori_m->hapus($id);
        
        redirect(site_url('admin/kategori'));
    }
    
    public function aktifasi($id = 0, $aktif = 0) {
        $id OR redirect(site_url('admin/kategori'));
        
        $this->kategori_m->update($id,array('status'=>$aktif));
        
        redirect(site_url('admin/kategori'));
    }
    
}