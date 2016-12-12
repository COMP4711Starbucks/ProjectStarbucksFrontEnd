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

/**
 * Modified to use REST client to get port data from our server.
 */
define('REST_SERVER', 'http://backend.local');  // the REST server host
define('REST_PORT', $_SERVER['SERVER_PORT']);   // the port you are running the server on

class Menu extends CI_Model{
    // Constructor
    public function __construct(){
        parent::__construct();
        $this->load->library(['curl', 'format', 'rest']);
    }
    
    // Return all records as an array of objects
    function all()
    {
        $this->rest->initialize(array('server' => REST_SERVER));
        $this->rest->option(CURLOPT_PORT, REST_PORT);
        return $this->rest->get('menu/maintenance');
    }
    
    function rules() {
        $config = [
            ['field'=>'name', 'label'=>'Item name', 'rules'=> 'required'],
            ['field'=>'description', 'label'=>'Item description', 'rules'=> 'required|max_length[256]'],
            ['field'=>'price', 'label'=>'Item price', 'rules'=> 'required|decimal']
        ];
        return $config;
    }
    
    // Retrieve an existing DB record as an object
    function get($key, $key2 = null)
    {
            $this->rest->initialize(array('server' => REST_SERVER));
            $this->rest->option(CURLOPT_PORT, REST_PORT);
            return $this->rest->get('menu/maintenance/item/id/' . $key);
    }
    
    // Create a new data object.
    // Only use this method if intending to create an empty record and then
    // populate it.
    function create()
    {
        $names = ['name','description','price','picture'];
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
            return $this->rest->delete('menu/maintenance/item/id/' . $key);
    }
    
    // Determine if a key exists
    function exists($key, $key2 = null)
    {
            $this->rest->initialize(array('server' => REST_SERVER));
            $this->rest->option(CURLOPT_PORT, REST_PORT);
            $result = $this->rest->get('menu/maintenance/item/id/' . $key);
            return ! empty($result);
    }
    
    // Update a record in the DB
    function update($record)
    {
            $this->rest->initialize(array('server' => REST_SERVER));
            $this->rest->option(CURLOPT_PORT, REST_PORT);
            $retrieved = $this->rest->put('menu/maintenance/item/id/' . $record['code'], $record);
    }
    
    // Add a record to the DB
    function add($record)
    {
            $this->rest->initialize(array('server' => REST_SERVER));
            $this->rest->option(CURLOPT_PORT, REST_PORT);
            $retrieved = $this->rest->post('menu/maintenance/item/id/' . $record['code'], $record);
    }
}
