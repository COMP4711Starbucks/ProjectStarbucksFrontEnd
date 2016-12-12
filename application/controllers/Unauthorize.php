<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Unauthorize
 *
 * @author TianyangLiu
 */
class Unauthorize extends Application{
    public function index(){
        $this->data['pagebody'] = 'unauthorize';
        $message = 'You are not authorized to access this page.';
        $this->data['content'] = $message;
        $this->render();
    }
}
