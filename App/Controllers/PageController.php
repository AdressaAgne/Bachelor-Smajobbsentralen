<?php
namespace App\Controllers;

use View, StackController;


class PageController extends Controller implements StackController{
    
    public function index(){
        
        
    }
    
    public function item($url){
        
        $page = $this->select('pages', ['*'], ['permalink' => $url['id']], 'Page')->fetch();
        
        return View::make('pages.normal', ['page' => $page]);
        
    }
    
    public function put($data){
        // New Page
        
        $this->insert('pages', [[
            'header'    => $data['header'],
            'content'   => $data['content'],
            'permalink' => $data['permalink'],
            'visible'   => isset($data['visible']),
        ]]);
        
        return View::make('admin');
    }
    
    public function patch($data){
        // Update Page
        
        $this->updateWhere('pages', [
            'header'    => $data['header'],
            'content'   => $data['content'],
            'permalink' => $data['permalink'],
            'visible'   => isset($data['visible']),
        ], ['id' => $data['id']]);
        
        return ['patch'];
    }
    
    public function edit($url){
        return ['edit'];
    }
    
    public function delete($data){
        // Delete Page
        return ['del'];
    }
}
