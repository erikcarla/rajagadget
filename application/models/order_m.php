<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_m extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        parent::set_table('order','id_order');
    }
    
    public function insert($data = array(), $cart = array()) {
        if(parent::insert($data)){
            $id = $this->db->insert_id();
            foreach ($cart as $item){
                $detail = array( 'order_id'=>$id,
                                 'produk_id'=>$item['id'],
                                 'kuantitas'=>$item['qty'],
                                 'subtotal'=>$item['subtotal']);
                $this->db->insert('order_data',$detail);
            }
            return true;
        }
        return false;
    }
    
    public function get_record($id = 0,$get_user = FALSE) {
        $this->db->where($id);
        if ($get_user){
            $this->db->join('user_data','user_data.user_id = order.user_id');
        }
        $data = parent::get_array();
        foreach ($data as $key=>$val){
            $this->db->where(array('order_id'=>$val['id_order']));
            $this->db->join('produk','produk.id_produk = order_data.produk_id');
            
            $detail = $this->db->get('order_data')->result_array();
            $data[$key]['detail'] = $detail;
            
            switch($data[$key]['status_order']) {
                case '0':
                $data[$key]['status_order_text'] = '<div style="color:red;">Data belum diproses</div>';
                continue;
                
                case '1':
                $data[$key]['status_order_text'] = '<div style="color:orange;">Data sedang diproses</div>';
                continue;
                
                case '2':
                $data[$key]['status_order_text'] = '<div style="color:blue;">Barang sedang dikirim</div>';
                continue;
                
                case '3':
                $data[$key]['status_order_text'] = '<div style="color:green;">Selesai</div>';
                continue;
            }          
        } 
        return $data;
    }
    
    public function get_laporan(){
        $this->db->join('user','user.id_user=order.user_id');
        $this->db->join('user_data','user_data.user_id=user.id_user');
        $data = parent::get_array();
        foreach ($data as $key=>$val){
            $this->db->where(array('order_id'=>$val['id_order']));
            $this->db->join('produk','produk.id_produk = order_data.produk_id');
            $detail = $this->db->get('order_data')->result_array();
            $data[$key]['detail'] = $detail;
            
            switch($data[$key]['status_order']) {
                case '0':
                $data[$key]['status_order_text'] = '<div style="color:red;">Data belum diproses</div>';
                continue;
                
                case '1':
                $data[$key]['status_order_text'] = '<div style="color:orange;">Data sedang diproses</div>';
                continue;
                
                case '2':
                $data[$key]['status_order_text'] = '<div style="color:blue;">Barang sedang dikirim</div>';
                continue;
                
                case '3':
                $data[$key]['status_order_text'] = '<div style="color:green;">Selesai</div>';
                continue;
            }            
        } 
        return $data;
    }
}
?>