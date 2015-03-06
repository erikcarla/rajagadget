<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk_m extends MY_Model {
    private $tabel_foto = 'foto_produk';
    
    public function __construct(){
        parent::__construct();
        parent::set_table('produk','id_produk');
    }
    
    public function get_all() {
        $this->db->order_by('kategori_id');
        $this->db->join('kategori','kategori.id_kategori=produk.kategori_id');
        return parent::get_all();
    }
    
    public function get_all_produk($url = ''){
        $data = array();
        $this->db->where(array('kategori.url'=>$url,'produk.status_produk'=>'1'));
        $i=0;
        foreach ($this->get_all() as $item){
            $data[$i] = $item;
            $this->db->where(array('produk_id'=>$item->id_produk,'default'=>'1'));
            if($this->db->get('foto_produk')->num_rows() > 0){
                $this->db->where(array('produk_id'=>$item->id_produk,'default'=>'1'));
                $foto = $this->db->get('foto_produk')->result();
                foreach ($foto as $pic) {
                    $data[$i]->image = $pic->image;
                    $data[$i]->thumb = $pic->thumb;
                }
            } else {
                $data[$i]->image = '';
                $data[$i]->thumb = '';
            }
            $i++;
        }
        return $data;
    }
    
    public function get_by_url($url) {
        if($data = parent::get_by(array('url_produk'=>$url))){
            $data->picture = array();
            $this->db->where(array('produk_id'=>$data->id_produk));
            if($this->db->get('foto_produk')->num_rows() > 0){
                $this->db->where(array('produk_id'=>$data->id_produk));
                $foto = $this->db->get('foto_produk')->result();
                $x=0;
                foreach ($foto as $pic) {
                    if($pic->default == 1){
                        $data->image = $pic->image;
                        $data->thumb = $pic->thumb;
                    }else{
                        $data->picture[$x]['image'] = $pic->image;
                        $data->picture[$x]['thumb'] = $pic->thumb;
                    }
                    $x++;
                }
            }
            return array($data);
        }
        return false;
    }
    
    /*SEKSI GAMBAR*/
    
    public function tambah_gambar($data = array()){
        $this->db->insert($this->tabel_foto,$data);
        $id = $this->db->insert_id();
    }
    
    public function get_gambar($id = 0) {
        $this->db->where(array('produk_id'=>$id));
        return $this->db->get($this->tabel_foto)->result();
    }
    
    public function set_default($id = 0, $id_foto = 0) {
        $data1 = array('default'=>0);
        $this->db->where(array('produk_id'=>$id));
        if($this->db->update($this->tabel_foto,$data1)) {
            $this->_set_to_default($id_foto);
            return true;
        }
        return false;
    }
    
    public function hapus_foto($id_foto= 0){
        $this->db->where(array('id_foto_produk'=>$id_foto));
        $data = $this->db->get($this->tabel_foto)->row();
        if($this->db->delete($this->tabel_foto,array('id_foto_produk'=>$id_foto))) {
            if(file_exists($data->image)){
                unlink($data->image);
            }
            if(file_exists($data->thumb)){
                unlink($data->thumb);
            }
        }
    }
    
    private function _set_to_default($id_foto = 0) {
        $data2 = array('default'=>1);
        $this->db->where(array('id_foto_produk'=>$id_foto));
        $this->db->update($this->tabel_foto,$data2);
    }
    
}

?>