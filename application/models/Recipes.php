<?php

/**
 *
 * @author lizewu
 */
class Recipes extends CI_Model {

	// Constructor
	public function __construct(){
            
            parent::__construct("Recipes","menu_id","inventory_id");
            $this->load->library(['curl', 'format', 'rest']);
	}

        function rules() {
            $config = [
                ['field'=>'quantity', 'label'=>'Item name', 'rules'=> 'required|integer']
            ];
            return $config;
        }
	// retrieve a single menu
	public function get($which,$key)
	{
            // iterate over the data until we find the one we want
            foreach ($this->all() as $record){
                    if ($record->menu_id == $which && $record->inventory_id == $key){
                            return $record;
                    }
            }
            return null;
	}
//
//	// retrieve all of the menus
//	public function all()
//	{
//            return $this->data;
//	}
       
  	public function getRecipe($which){
            $result = $this->all();
            $recipy = array();
            $menu = $this->menu->all();
            $item = $this->inventories->all();
            $name = $which;
            // iterate over the data until we find the one we want
            foreach ($result as $record){
                if ($record->menu_id == $name){
                    $r['menu'] = $record->menu_id;
                    $r['item'] = $record->inventory_id;
                    $r['Quantity'] = $record->quantity;
                    $r['id'] = $which;
                    foreach($menu as $m){
                        if($m->id == $record->menu_id){
                            $r['menuname'] = $m->name;
                        }    
                    }
                    foreach($item as $i){
                        if($i->id == $record->inventory_id){
                            $r['itemname'] = $i->name;
                        }   
                    }
                    $recipy[] = $r;
                }
            }
            return $recipy;
	}
        
        public function getEdit($which){
            $result = $this->all();
            $recipy = array();
            $name = $which;
            // iterate over the data until we find the one we want
            foreach ($result as $record){
                if ($record->menu_id == $name){
                    $recipy[] = $record;
                }
            }
            return $recipy;
	}
        
        public function getName($which){
           
           $menu = $this->menu->all();
            // iterate over the data until we find the one we want
            
                foreach($menu as $m){
                  if ($m->id == $which){
                    return $m->name;
                    }    
                }
                
            
            return null;
	}
        public function getItemName($which){
            $result = $this->all();
            $item = $this->inventories->all();
            // iterate over the data until we find the one we want
            foreach ($item as $record){
                if ($record->id == $which){
                    return $record->name;
                }
            }
            return null;
        }
        public function getItem($which){
           $result = $this->all();
            // iterate over the data until we find the one we want
            foreach ($result as $record){
                if ($record->menu_id == $which){
                    return $record->inventory_id;
                }
            }
            return null;
	}
        
        public function getItems($id){
           $result = $this->all();
           $names = array();
            // iterate over the data until we find the one we want
            foreach ($result as $record){
                if (!in_array($record->inventory_id, $names) && $record->menu_id == $id){
                    $names[] = $record->inventory_id;
                }
            }
            return $names;
	}
        
        public function getNames(){
           $result = $this->all();
           $names = array();
            // iterate over the data until we find the one we want
            foreach ($result as $record){
                if (!in_array($record->inventory_id, $names)){
                    $a['id'] = $record->inventory_id;
                    $a['item'] = $this->getItemName($record->inventory_id);
                    $names[] = $a;
                }
            }
            return $names;
	}
        
        public function names(){
           $name = array();
           $names = array();
           $result = $this->all();
          
            // iterate over the data until we find the one we want
            foreach ($result as $record){ 
                if (!in_array($record->menu_id, $name)){
                    $names[] = array('id' => $record->menu_id, 'name' => $this->getName($record->menu_id));
                    $name[] = $record->menu_id;
                }
            }
            
            return $names;
	}
        
        public function valueForm($id){
            $result = $this->all();
          
            // iterate over the data until we find the one we want
            foreach ($result as $record){ 
                if($record->menu_id == $id){ 
                    return $record;
                }
            }
            return null;
            
        }
        
        // Return all records as an array of objects
        function all()
        {
                $this->rest->initialize(array('server' => REST_SERVER));
                $this->rest->option(CURLOPT_PORT, REST_PORT);
                return $this->rest->get('recipe/maintenance');
        }
  
        // Retrieve an existing DB record as an object
        /*function get($key, $key2 = null)
        {
                $this->rest->initialize(array('server' => REST_SERVER));
                $this->rest->option(CURLOPT_PORT, REST_PORT);
                return $this->rest->get('/maintenance/item/id/' . $key);
        }*/
        
        // Create a new data object.
        // Only use this method if intending to create an empty record and then
        // populate it.
        function create()
        {
            $names = ['id','name','description','price','picture','category'];
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
                return $this->rest->delete('recipe/maintenance/item/id/' . $key);
        }
        
        // Determine if a key exists
        function exists($key, $key2 = null)
        {
                $this->rest->initialize(array('server' => REST_SERVER));
                $this->rest->option(CURLOPT_PORT, REST_PORT);
                $result = $this->rest->get('recipe/maintenance/item/id/' . $key . '-' . $key2);
                return ! empty($result);
        }
        
        // Update a record in the DB
        function update($record)
        {
                $this->rest->initialize(array('server' => REST_SERVER));
                $this->rest->option(CURLOPT_PORT, REST_PORT);
                $retrieved = $this->rest->put('recipe/maintenance/item/id/' . $record['code'], $record);
        }
        
        // Add a record to the DB
        function add($record)
        {
                $this->rest->initialize(array('server' => REST_SERVER));
                $this->rest->option(CURLOPT_PORT, REST_PORT);
                $retrieved = $this->rest->post('recipe/maintenance/item/id/' . $record['code'], $record);
        }
}





