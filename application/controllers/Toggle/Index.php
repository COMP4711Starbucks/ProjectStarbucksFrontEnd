<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of index
 *
 * @author TianyangLiu
 */
class Index extends Application{
    
    public function switch_userrole(){
        $origin = $_SERVER['HTTP_REFERER'];
        $role = $this->session->userdata('userrole');
        
        if ($role == 'user') {
            $role = 'admin';
        }else if($role == 'admin'){
            $role = 'guest';
        }else {
            $role = 'user';
        }
        
        $this->session->set_userdata('userrole', $role);
        
        redirect($origin);
    }
}
