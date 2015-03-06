<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_m extends MY_Model {
    
    public function __construct(){
        parent::__construct();
        parent::set_table('user_data','id_user_data');
    }
    
}
?>