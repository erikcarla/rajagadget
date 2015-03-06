<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori_m extends MY_Model {
    private $prefix = array();
    private $tabel_produk = 'produk';
    
    public $kategori = array();
    public $kategori_menu = '';
    public $kategori_menu_list = '';
    
    public function __construct(){
        parent::__construct();
        parent::set_table('kategori','id_kategori');
        self::get_kategori();
        self::get_kategori_menu();
        
        $this->kategori_menu_list = '<ul>'.$this->kategori_menu.'</ul>';
    }
    
    public function hapus($id = 0) {
        if($data = parent::get($id)) {
            if(parent::update_by(array('parent'=>$id),array('parent' => $data->parent))) {
                $this->update_produk($id,$data->parent);
                parent::delete($id);
                return true;
            }
            return false;
        }
        return false;
    }
    
    private function update_produk($old = 0,$new = 0) {
        $this->db->where(array('kategori_id'=>$old));
        $this->db->update('produk',array('kategori_id'=>$new));
    }
    
    private function get_kategori($find_child = FALSE,$parent_id = '0') {
        if($find_child == FALSE){
            $older = parent::get_many_by(array('parent'=>'0'));
            foreach ($older as $parent) {
                $this->kategori[] = array ( 'id_kategori'   =>$parent->id_kategori, 
                                    'kode_kategori' =>$parent->kode_kategori, 
                                    'nama_kategori' =>$parent->nama_kategori,
                                    'deskripsi'     =>$parent->deskripsi,
                                    'parent'        =>$parent->parent,
                                    'status'        =>$parent->status,
                                    'ori_name'      =>$parent->nama_kategori
                                    );
                $this->get_kategori(TRUE,$parent->id_kategori);
                array_shift($this->prefix);
            }
        }else{
            array_push($this->prefix,'-- ');
            if(parent::get_many_by(array('parent'=>$parent_id))) {
                $child = parent::get_many_by(array('parent'=>$parent_id));
                
                foreach ($child as $item) {
                    $this->kategori[] = array ( 'id_kategori'   =>$item->id_kategori, 
                                        'kode_kategori' =>$item->kode_kategori, 
                                        'nama_kategori' =>implode('',$this->prefix).$item->nama_kategori,
                                        'deskripsi'     =>$item->deskripsi,
                                        'parent'        =>$item->parent,
                                        'status'        =>$item->status,
                                        'ori_name'      =>$item->nama_kategori
                                        );
                    $this->get_kategori(TRUE,$item->id_kategori);
                    array_shift($this->prefix);
                }
            }
        }
    }
    
    private function get_kategori_menu($find_child = FALSE,$parent_id = '0') {
        if($find_child == FALSE){
            $older = parent::get_many_by(array('parent'=>'0','status'=>'1'));
            foreach ($older as $parent) {
                $this->kategori_menu .= '<li>'.anchor(site_url('/produk/'.$parent->url), $parent->nama_kategori);
                $this->get_kategori_menu(TRUE,$parent->id_kategori);
                $this->kategori_menu .= '</li>';
            }
        }else{
            
            if(parent::get_many_by(array('parent'=>$parent_id))) {
                $this->kategori_menu .= '<ul>';
                $child = parent::get_many_by(array('parent'=>$parent_id,'status'=>'1'));
                foreach ($child as $item) {
                    $this->kategori_menu .= '<li>'.anchor(site_url('/produk/'.$item->url), $item->nama_kategori);
                    $this->get_kategori_menu(TRUE,$item->id_kategori);
                    $this->kategori_menu .= '</li>';
                }
                $this->kategori_menu .= '</ul>';
            }
            
        }
    }
}