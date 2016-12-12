<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of recipy
 *
 * @author lizewu
 */
class Detail extends Application{
    //put your code here
    function __construct()
    {
            parent::__construct();
            $this->load->helper('formfields');
            $this->error_messages = array();
    }
    
    
    public function detail($id)
    {
        //$this->load->model('recipes');
        $role = $this->session->userdata('userrole');
        if($role == "guest"){
            redirect('/unauthorize');
        }    
        $this->data['pagebody'] = 'recipy_detail';
        $this->data['detail']= $this->recipes->getRecipe($id);
        $this->data['name'] = $this->recipes->getName($id);
        $this->data['id'] = $id;
        $this->render(); 
    }
    
    function edit($id = null) {
        $role = $this->session->userdata('userrole');
        if($role == "guest" || $role == "user"){
                redirect('/unauthorize');
        }
        if($id != null){
            $pieces = explode("-", $id);
            $menu = $pieces[0];
            $item = $pieces[1];
        }

        $counter = 0;
        
        $key = $this->session->userdata('key');  
        $key1 = $this->session->userdata('key1');
        $record = $this->session->userdata('record');   
        
        if (empty($record)) {            
            $record = $this->recipes->get($menu,$item);           
            $key = $menu; 
            $key1 = $item;
            $this->session->set_userdata('key',$menu); 
            $this->session->set_userdata('key1',$item); 
            $this->session->set_userdata('record',$record);   
        }
    // try the session first
        
        foreach($this->recipes->getEdit($key) as $i){
            if($key1 == $i->inventory_id){
                $this->data['fquantity'] = makeTextField('', 'quantity', $i->quantity);
                $counter = 1;
            }
        }
        if($counter == 0){
            echo "404";
            return;
        }
        
        $this->data['name'] = $this->recipes->getName($key);
        $this->data['zsubmit'] = makeSubmitButton('Save', 'Submit changes');
        $this->data['fname'] =  $this->recipes->getItemName($key1);
        $this->data['pagebody'] = 'recipy_detail_edit';
        // show the editing form
        $this->show_any_errors();
        $this->render();
    }
    function cancel() {
        $key = $this->session->userdata('key');
        $this->session->unset_userdata('key');
        $this->session->unset_userdata('key1');
        $this->session->unset_userdata('record');
        $this->detail($key);
    }
    
    function addItem($id){
        $role = $this->session->userdata('userrole');
        if($role == "guest" || $role == "user"){
                redirect('/unauthorize');
        }
        $this->session->set_userdata('key',$id);
        $this->data['fquantity'] = makeTextField('', 'quantity', 1);
        $cats = $this->recipes->getNames();
        $already = $this->recipes->getItems($id);
        foreach($cats as $code){ 
            if( !(in_array($code['id'], $already))){
              $codes[$code['id']] = $code['item'];  
            } 
        }
        
        $this->data['name'] = $this->recipes->getName($id);
        $this->data['zsubmit'] = makeSubmitButton('Save', 'Submit changes');
        $this->data['fname'] = makeCombobox('', 'inventory_id', $this->recipes->getItem($id),$codes);
        $this->data['pagebody'] = 'recipy_detail_add';
        // show the editing form
        $this->show_any_errors();
        $this->render(); 
    }
    
    function add(){
        $key = $this->session->userdata('key');
        $key1 = $this->session->userdata('key1');
        $record = $this->session->userdata('record');

        // if not there, nothing is in progress
        if (empty($record)) {
            $record = $this->recipes->valueForm($key);
        }
        $incoming = $this->input->post();
        foreach(get_object_vars($record) as $index => $value)
            if (isset($incoming[$index]))
                $record->$index = $incoming[$index];
        $this->session->set_userdata('record',$record);
        // validate
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->recipes->rules());
        if ($this->form_validation->run() != TRUE)
                $this->error_messages = $this->form_validation->error_array();

        // save or not
        if (! empty($this->error_messages)) {
            $this->add();
            return;
        }

        // update our table, finally!
        $this->recipes->add($record);
          
        $this->session->unset_userdata('key');
        $this->session->unset_userdata('key1');
        $this->session->unset_userdata('record');
        // and redisplay the list
        $this->detail($key);
    }
            
    function save() {
        // try the session first
        $key = $this->session->userdata('key');
        $key1 = $this->session->userdata('key1');
        $record = $this->session->userdata('record');

        // if not there, nothing is in progress
        if (empty($record)) {
            $this->index();
            return;
        }
        $incoming = $this->input->post();
        foreach(get_object_vars($record) as $index => $value)
            if (isset($incoming[$index]))
                $record->$index = $incoming[$index];
        $this->session->set_userdata('record',$record);
        // validate
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->recipes->rules());
        if ($this->form_validation->run() != TRUE)
                $this->error_messages = $this->form_validation->error_array();

        // save or not
        if (! empty($this->error_messages)) {
            $this->edit();
            return;
        }

        // update our table, finally!
        if ($key == null){
            $this->recipes->add($record);
        }else{
            $this->recipes->update($record);
        }
        
        $this->session->unset_userdata('key');
        $this->session->unset_userdata('key1');
        $this->session->unset_userdata('record');
        // and redisplay the list
        $this->detail($key);
    }

    function delete() {
        $key = $this->session->userdata('key');
        $key1 = $this->session->userdata('key1');
        $record = $this->session->userdata('record');

        // only delete if editing an existing record
        if (! empty($record)) {
            
            $this->recipes->delete($key,$key1);
        }
        $this->session->unset_userdata('key');
        $this->session->unset_userdata('key1');
        $this->session->unset_userdata('record');
        
        $this->detail($key);
    }
    
    function show_any_errors() {
        $result = '';
        if (empty($this->error_messages)) {
            $this->data['error_messages'] = '';
            return;
        }
        // add the error messages to a single string with breaks
        foreach($this->error_messages as $onemessage)
            $result .= $onemessage . '<br/>';
        // and wrap these per our view fragment
        $this->data['error_messages'] = $this->parser->parse('recipy_detail_error',
                ['error_messages' => $result], true);
    }
    
}
