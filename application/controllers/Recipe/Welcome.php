<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Welcome
 *
 * @author lizewu
 */
class Welcome extends Application{
    //put your code here
    function __construct()
    {
            parent::__construct();
    }
    
    public function index()
    {
        $role = $this->session->userdata('userrole');
            if($role == "guest"){
                redirect('/unauthorize');
            }
        //$this->load->model('recipes');
        $this->data['pagebody'] = 'recipy_list';
        $this->data['names'] = $this->recipes->names();
        $this->render(); 
    }
}
