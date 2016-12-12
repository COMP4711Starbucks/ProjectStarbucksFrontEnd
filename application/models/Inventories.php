<?php

/**
 * @author Daniel Zhang
 */
class Inventories extends MY_Model {
    // Constructor
    public function __construct()
    {
        parent::__construct();
    }

    public function rules() { 
        $config = [
            ['field'=>'name', 'label'=>'Inventory name', 'rules'=> 'required'], 
            ['field'=>'quantity', 'label'=>'Inventory quantity', 'rules'=> 'required|integer']
        ];
        return $config; 
    }
    
    // retrieve recipes by passing inventory id
    public function getMenu($id)
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
    
//    // retrieve one single inventory by passing name
//    public function getInventory($id){
//        $source = array();
//        $name = $this->getName($id);
//        
//        $result = $this->all();
//        // iterate over the data until we find the one we want
//        foreach ($result as $record){
//            if ($record->name == $name){
//                $source[] = $record;
//            }
//        }
//        return $source;
//    }
    
    // retrieve one inventory name by passing id
    public function getName($id){
        $result = $this->all();
        // iterate over the data until we find the one we want
        foreach ($result as $record){
            if ($record->id == $id){
                return $record->name;
            }
        }
        return null;
    }
}