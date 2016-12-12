<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends Application{
    function __construct(){
        parent::__construct();
    }
    
    public function index(){
        // What is the user up to?
        if ($this->session->has_userdata('order')){
            $this->show_selected_items();
        }else {
            $this->empty_cart();
        }
    }
    
    public function show_selected_items() {
        $order = new Order($this->session->userdata('order'));
        $stuff = $order->receipt();
        $this->data['receipt'] = $this->parsedown->parse($stuff);
        
        $this->data['pagebody'] = 'cart';
        $this->render(); 
    }
    
    public function empty_cart(){
        $this->data['pagebody'] = 'cart';
        $this->data['receipt'] = "You haven't order anything yet";
        $this->render();
    }
    
    public  function checkout(){
        if ($this->session->has_userdata('order')){
            $order = new Order($this->session->userdata('order'));

            $order->save();
            $this->session->unset_userdata('order');
            
            redirect('/menu');
        }else {
            redirect('/menu');
        }
        
    }
    
    public function cancel() {
        // Drop any order in progress
        if ($this->session->has_userdata('order')) {
            $this->session->unset_userdata('order');
        }

        redirect('/menu');
    }
}
