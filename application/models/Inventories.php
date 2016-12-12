<?php

/**
 * @author Daniel Zhang
 */
class Inventories extends CI_Model {
    // Constructor
    function __construct()
    {
        parent::__construct();
        $this->load->library(['curl', 'format', 'rest']);
    }

    function rules() { 
        $config = [
            ['field'=>'name', 'label'=>'Inventory name', 'rules'=> 'required'], 
            ['field'=>'quantity', 'label'=>'Inventory quantity', 'rules'=> 'required|integer']
        ];
        return $config; 
    }
    
    // retrieve recipes by passing inventory id
    function getMenu($id)
    {
        $recipes = $this->recipes->all();
        $menus = $this->menu->all();
        
        $recipe = array();
        $menu = array();
        
        foreach($recipes as $source) {
            if($source->inventory_id == $id){
                    $recipe[] = $source;
            }
        }  
        
        foreach($recipe as $r) {
            foreach($menus as $m) {
                if($r->menu_id == $m->id){
                        $menu[] = $m;
                }
            }
        }
        
        return $menu;
    }
    
    // retrieve one inventory name by passing id
    function getName($id){
        $result = $this->all();
        // iterate over the data until we find the one we want
        foreach ($result as $record){
            if ($record->id == $id){
                return $record->name;
            }
        }
        return null;
    }
    
    // Return all records as an array of objects
    function all()
    {
            $this->rest->initialize(array('server' => REST_SERVER));
            $this->rest->option(CURLOPT_PORT, REST_PORT);
            return $this->rest->get('inventory/maintenance');
    }
    
    // Retrieve an existing DB record as an object
    function get($key, $key2 = null)
    {
            $this->rest->initialize(array('server' => REST_SERVER));
            $this->rest->option(CURLOPT_PORT, REST_PORT);
            return $this->rest->get('inventory/maintenance/item/id/' . $key);
    }
    
    // Create a new data object.
    // Only use this method if intending to create an empty record and then
    // populate it.
    function create()
    {
        $names = ['id','name','quantity'];
        $object = new StdClass;
        foreach ($names as $name)
            $object->$name = "";
        return $object;
    }
    
    // Delete a record from the DB
    function delete($key, $key2 = null)
    {
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        return $this->rest->delete('inventory/maintenance/item/id/' . $key);
    }
    
    // Determine if a key exists
    function exists($key, $key2 = null)
    {
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $result = $this->rest->get('inventory/maintenance/check/id/' . $key);
        if($result->error == 'ok'){
            return false; 
        }else{
            return true;
        }
    }
    
    // Update a record in the DB
    function update($record)
    {
        $data = get_object_vars($record);
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $retrieved = $this->rest->put('inventory/maintenance/item/id/' . $data['id'], $data);
    }
    
    // Add a record to the DB
    function add($record)
    {
        $data = get_object_vars($record);
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        $retrieved = $this->rest->post('inventory/maintenance/item/id/' . $data['id'], $data);
    }
}