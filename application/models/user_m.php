<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        parent::set_table('user','id_user');
    }
    
    public function get_by_username($username) {
        if($query = parent::get_by(array('username'=>$username))){
            if ($query->id_user != NULL) return $query;
        }
        return false;
    }
    
    public function cek_username($username,$self = FALSE){
        if($data = parent::get_by(array('username'=>$username))){
            if($self){
                return $data->id_user;
            }else{
                return false;   
            }
        }
        return true;
    }
    
    public function hapus($id) {
        if(parent::delete($id)) {
            if($this->db->table_exists('user_data')){
                $this->db->where(array('user_id'=>$id));   
                $this->db->delete('user_data');
            }
            return true;
        }
        return false;
    }
    
}
?>