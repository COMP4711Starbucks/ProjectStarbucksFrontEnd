<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application{
    function __construct(){
        parent::__construct();
    }
    
    public function index(){
        $this->data['pagebody'] = 'menu';
        $result = $this->menu->all();
        $this->data['content'] = $result;
        $this->render();
    }
    
    public function add_item_to_order($what) {
        $this->createOrder();
        
        $order = new Order($this->session->userdata('order'));
        $order->additem($what);
        
        $this->index();
        $this->session->set_userdata('order',(array)$order);
        
        redirect('/menu');
    }
    
    public function createOrder(){
        // create a new order if needed
        if (! $this->session->has_userdata('order')) {
            $order = new Order();
            $this->session->set_userdata('order', (array) $order);
        }
    }
    
    public function sales_order() {
        // identify all of the order files
        $this->load->helper('directory');
        $candidates = directory_map('../data/');
        $parms = array();
        foreach ($candidates as $filename) {
           if (substr($filename,0,5) == 'order') {
               // restore that order object
               $order = new Order ('../data/' . $filename);
            // setup view parameters
               $parms[] = array(
                   'number' => $order->number,
                   'datetime' => $order->datetime,
                   'total' => $order->total()
                       );
            }
        }
        $this->data['orders'] = $parms;
        $this->data['pagebody'] = 'sales_order';
        $this->render('template');  // use the default template
    }
    
    public function examine($which) {
        $order = new Order ('../data/order' . $which . '.xml');
        $stuff = $order->receipt();
        $this->data['content'] = $this->parsedown->parse($stuff);
        $this->data['pagebody'] = 'review_order';
        $this->render();
    }
}