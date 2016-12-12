<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Crud
 *
 * @author TianyangLiu
 */
class Crud extends Application{
    function __construct(){
        parent::__construct();
        $this->load->helper('formfields');
        $this->error_messages = array();
    }
    
    public function index(){
        $userrole = $this->session->userdata('userrole');
        if ($userrole != 'admin') {
            redirect('/unauthorize');
        }

        $this->create();
    }
    
    public function create(){
        $key = NULL;
        $record = $this->menu->create();

        $this->session->set_userdata('key', $key);
        $this->session->set_userdata('record', $record);
        
        // build the form fields
        $this->data['fname'] = makeTextField('Item name', 'name', $record->name);
        $this->data['fdescription'] = makeTextArea('Description', 'description', $record->description);
        $this->data['fprice'] = makeTextField('Price', 'price', $record->price);
        
        $this->data['zsubmit'] = makeSubmitButton('Create', 'Submit changes');
        
        $this->data['pagebody'] = 'add_menu_item';
        $this->show_any_errors();
        $this->render();
    }
    
    public function save(){
         // try the session first
        $key = $this->session->userdata('key'); 
        $record = $this->session->userdata('record');
        
        // if not there, nothing is in progress 
        if (empty($record)) {
            $this->index();
        }
        
        // update our data transfer object
        $incoming = $this->input->post();
        foreach(get_object_vars($record) as $index => $value)
            if (isset($incoming[$index]))
                $record->$index = $incoming[$index];
        $this->session->set_userdata('record',$record);
        
        $newguy = $_FILES['picture'];
        if (!empty($newguy['name'])) {
            $record->picture = $this->upload_picture();
            if ($record->picture != null)
                $_POST['picture'] = $record->picture; // override picture name
        }
        $this->session->set_userdata('record',$record);
        
        // validate
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->menu->rules());
        
        if ($this->form_validation->run() != TRUE){
            $this->error_messages = $this->form_validation->error_array();
        }
        
        if ($key == null) 
                if ($this->menu->exists($record->name))
                        $this->error_messages[] = 'Duplicate item name';
                
        // save or not
        if (! empty($this->error_messages)) {
                $this->index();
                return;
        }

        // update our table, finally!
        if ($key == null)
                $this->menu->add($record);
        
        // and redisplay the list
        redirect('/menu');
    }
    
     // handle uploaded image, and use its name as the picture name
    function upload_picture() {
        $config = [
            'upload_path' => './images', // relative to front controller
            'allowed_types' => 'gif|jpg|jpeg|png',
            'remove_spaces' => TRUE, // eliminate any spaces in the name
            'overwrite' => TRUE, // overwrite existing image
        ];
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('picture')) {
            $this->error_messages[] = $this->upload->display_errors();
            return NULL;
        } else
            return $this->upload->data('file_name');
    }   
            
    public function cancel() {
        $this->session->unset_userdata('key');
        $this->session->unset_userdata('record');
        redirect('/menu');
    }
    
    function delete($id) {
        //$key = $this->session->userdata('key');
        $key = $id;
        $record = $this->session->userdata('record');
        // only delete if editing an existing record
        if (! empty($record)) {
            $result = $this->recipes->getItems($key);
            
            $this->menu->delete($key);
            
            foreach($result as $r){
                $this->recipes->deleteItems($key);
            }
        }
        
        $this->session->unset_userdata('key');
        $this->session->unset_userdata('record');
        
        redirect('/menu');
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
        $this->data['error_messages'] = $this->parser->parse('create-menu-item-errors',
                ['error_messages' => $result], true);
    }
}
