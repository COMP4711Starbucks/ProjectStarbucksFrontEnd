<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/
	 * 	- or -
	 * 		http://example.com/welcome/index
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            $this->data['pagebody'] = 'welcome_message';
            
            $menu = $this->menu->all();
            $count_menu = 0;
            foreach($menu as $m){
                $count_menu++;
            }
            
            $recipes = $this->recipes->all();
            $count_recipes = 0;
            foreach($recipes as $r){
                $count_recipes++;
            }
            
            
            $this->data['menu_counts'] = $count_menu;
            $this->data['recipe_counts'] = $count_recipes;
            $this->render(); 
	}
        
        
        
        
        
        
        // this is used for testing purpose
        public function counte($goods){
            $this->load->model('recipes');
            $this->load->model('inventories');
            $counter = array();
            
            $target = preg_replace("/[\s-&]/", "", $goods);
            
            foreach($this->recipes->all() as $detail){
                $orgin = preg_replace("/[\s&-]/", "", $detail['menu']);
                if($orgin == $target){
                    foreach ($this->inventories->all() as $item) {
                        if($item['name'] == $detail['item']){
                            $all = intval($item['quantity']);
                            $each = intval($detail['Quantity']);
                            $rest = $all % $each;
                            $counter[] = ($all - $rest)/ $each;
                        }
                    }   
                }
            }
            $this->data['pagebody'] = 'test';
            $this->data['rest'] = min($counter);   
            $this->render();
        }  
}
