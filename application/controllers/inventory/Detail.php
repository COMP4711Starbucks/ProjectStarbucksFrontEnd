<?php /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of inventory
 *
 * @author Daniel Zhang
 */
class Detail extends Application{
    //put your code here
    function __construct()
    {
        parent::__construct();
        $this->load->helper('formfields');
    }
    
    function detail($id)
    {       
        $userrole = $this->session->userdata('userrole');
        if ($userrole == 'guest') {
            redirect('/unauthorize');
        }
        
        $this->data['pagebody'] = 'inventory_recipe';
        $this->data['inventoryName']= $this->inventories->getName($id);
        $this->data['menu'] = $this->inventories->getMenu($id);
        $this->render(); 
    }
    
   function cancel(){
        $this->session->unset_userdata('key');
        $this->session->unset_userdata('record');
        redirect('/inventory');
    }
    
    function delete($id) {
        $key = $id;

        // only delete if editing an existing record
        if (! empty($key)) {
            echo $key;
            $this->inventories->delete($key);
        }
        redirect('inventory');
}
    
    function add()
    {       
        $key = NULL;
        $record = $this->inventories->create();
        
        $this->session->set_userdata('key', $key);
        $this->session->set_userdata('record', $record);    
        $this->edit();
    }
    
    function edit($id=null) {    
        // try the session first    
        $key = $this->session->userdata('key');
        $record = $this->session->userdata('record');
        // if not there, get them from the database   
        if (empty($record)) {            
            $record = $this->inventories->get($id);
            $key = $id;           
            $this->session->set_userdata('key',$id);            
            $this->session->set_userdata('record',$record);   
        }
        
        $this->data['action'] = (empty($key)) ? 'Adding' : 'Editing';
        
        // build the form fields
        $this->data['fname'] = makeTextField('Inventory name', 'name', $record->name);
        $this->data['fquantity'] = makeTextField('Quantity', 'quantity', $record->quantity);
        $this->data['zsubmit'] = makeSubmitButton('Save', 'Submit changes');
        
        // show the editing form
        $this->data['pagebody'] = "inventory_recipe_add";
        $this->show_any_errors();
        $this->render();
    }
    
    function save() {
        // try the session first
        $key = $this->session->userdata('key');
        $record = $this->session->userdata('record');

        // if not there, nothing is in progress
        if (empty($record)) {
            $this->index();
            return;
        }
 
        // update our data transfer object
        $incoming = $this->input->post();
        foreach(get_object_vars($record) as $index => $value)
            if (isset($incoming[$index]))
                $record->$index = $incoming[$index];
        $this->session->set_userdata('record',$record);
        
        // validate
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->inventories->rules());
        if ($this->form_validation->run() != TRUE)
            $this->error_messages = $this->form_validation->error_array();
        
        // check menu code for additions
        if ($key == null) 
            if ($this->inventories->exists($record->name))
                $this->error_messages[] = 'Duplicate name adding new menu item';
            
        // save or not
        if (! empty($this->error_messages)) {
                $this->edit();
                return;
        }

        // update our table, finally!
        if ($key == null)
            $this->inventories->add($record);
        else
            $this->inventories->update($record);
        
        $this->session->unset_userdata('key');
        $this->session->unset_userdata('record');
        
        //redirect
        redirect('inventory');
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
        $this->data['error_messages'] = $this->parser->parse('inventory_recipe_error',['error_messages' => $result], true);
    }
}