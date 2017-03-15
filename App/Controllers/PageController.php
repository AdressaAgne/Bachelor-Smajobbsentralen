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
        
        $id = $this->insert('pages', [[
            'header'    => $data['header'],
            'content'   => $data['content'],
            'permalink' => $data['permalink'],
            'style'     => $data['style'],
            'visible'   => isset($data['visible']),
        ]]);
        
        return Direct::re('/page/'.$data['permalink']);
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
        
        return View::make('editpage', ['page' => $page], true);
    }
    
    public function delete($data){
        // Delete Page

        $this->deleteWhere('pages', 'id', $data['id']);
        
        return Direct::re('/admin/pages');
    }
}
