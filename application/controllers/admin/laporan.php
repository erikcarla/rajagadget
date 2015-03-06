<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends MY_Controller {
    private $judul = 'Laporan';
    
    public function __construct() {
        parent::__construct();
        parent::set_judul($this->judul);
        parent::default_meta();
        $this->load->model('order_m');
        
        $this->data->metadata = $this->template->get_metadata();
        $this->data->judul = $this->template->get_judul();
    }
    
    public function index(){
        $this->data->laporan = $this->order_m->get_laporan();
        
        parent::_view('laporan/list',$this->data);
    }
    
    public function detail($id = 0) {
        if ($this->input->post('submit')){
            $this->order_m->update_by(array('id_order'=>$id),array('status_order'=>$this->input->post('status')));
            $this->data->sukses = 'Data berhasil diperbaharui';   
        } else {
            $this->data->detail = $this->order_m->get_record(array('id_order'=>$id),true);
        }
        
        parent::_modal('laporan/detail',$this->data);
    }
}