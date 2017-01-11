<?php
namespace App\Controllers;

use View, Direct, StackController;


class PageController extends Controller implements StackController{
    
    public function index(){
        
        
    }
    
    public function item($url){
        
        $page = $this->select('pages', ['*'], ['permalink' => $url['id']], 'Page')->fetch();
        
        return View::make('index', ['page' => $page]);
        
    }
    
    public function put($data){
        // New Page
        
        $this->insert('pages', [[
            'header'    => $data['header'],
            'content'   => $data['content'],
            'permalink' => $data['permalink'],
            'type'      => $data['type'],
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
        
        return Direct::re('/page/'.$data['permalink']);
    }
    
    public function edit($url){
        
        $page = $this->select('pages', ['*'], ['permalink' => $url['id']], 'Page')->fetch();
        
        return View::make('admin.editpage', ['page' => $page]);
    }
    
    public function delete($data){
        // Delete Page

        $this->deleteWhere('pages', 'id', $data['id']);
        
        return Direct::re('/admin');
    }
}
