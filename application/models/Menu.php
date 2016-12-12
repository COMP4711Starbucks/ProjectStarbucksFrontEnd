<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author TianyangLiu
 */
class Menu extends MY_Model{
    // Constructor
    public function __construct(){
        parent::__construct();
    }
    
    public function all(){
        $name = "name";
        $this->db->order_by($name, 'asc');
        $query = $this->db->get($this->_tableName);
        return $query->result();
    }
    
    function rules() {
        $config = [
            ['field'=>'name', 'label'=>'Item name', 'rules'=> 'required'],
            ['field'=>'description', 'label'=>'Item description', 'rules'=> 'required|max_length[256]'],
            ['field'=>'price', 'label'=>'Item price', 'rules'=> 'required|decimal']
        ];
        return $config;
    }
    
    /*
    // find and return item by name
    public function find($name){
        // replace '-', '&' symbols
        $target = preg_replace("/[\s-&]/", "", $name);
        $noItemIsFound = array('name' => 'Cannot find item');
        
        foreach($this->data as $d){
            $orgin = preg_replace("/[\s&-]/", "", $d['name']);
            if($orgin == $target){
                return $d;
            }
        }
        
        return $noItemIsFound;
    }
     * 
     */
}
