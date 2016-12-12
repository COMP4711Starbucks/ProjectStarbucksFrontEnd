<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/
     * 	- or -
     * 		http://example.com/welcome/index
     *
     * So any other public methods not prefixed with an underscore will
     * map to /welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     * 
     * 
    * @author Daniel Zhang
     */
    public function index()
    {
        $userrole = $this->session->userdata('userrole');
        if ($userrole == 'guest') {
            redirect('/unauthorize');
        }
        
        // get the all the ingredents from out model
        $source = $this->inventories->all();

        $this->data['ingreds'] = $source;
        $this->data['pagebody'] = 'inventory';
        
        $this->render(); 
    }
}
