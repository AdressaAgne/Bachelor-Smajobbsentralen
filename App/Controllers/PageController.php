<?php
namespace App\Controllers;

use View, Direct, StackController, Config;


class PageController extends Controller implements StackController{
    
    public function index(){
        
        
    }
    
    public function item($url){
        $page = $this->select('pages', ['*'], ['permalink' => $url['id']], 'Page')->fetch();
        $controller = $this->callThemeController($page);
        if($controller[0]){
            return $controller[1];
        }
        
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
            'parent'    => $data['parent'],
            'image'     => $data['image'],
            'style'     => $data['style'],
            'visible'   => isset($data['visible']),
        ], ['id' => $data['id']]);
        
        return Direct::re('/page/'.$data['permalink']);
    }
    
    public function edit($url){
        
        $page = $this->select('pages', ['*'], ['permalink' => $url['id']], 'Page')->fetch();
        $pages = $this->query('SELECT * FROM pages WHERE permalink != :id', ['id' => $url['id']], 'Page')->fetchAll();
        $media = $this->select('image', ['*'], null, 'image');
        
        
        $types = $this->getFiles('./view/'.Config::$theme.'/view/pages');
        
        return View::make('editpage', ['page' => $page, 'parents' => $pages, 'media' => $media, 'types' => $types], true);
    }
    
    public function delete($data){
        // Delete Page

        $this->deleteWhere('pages', 'id', $data['id']);
        
        return Direct::re('/admin/pages');
    }
    
}
