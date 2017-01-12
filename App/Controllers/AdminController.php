<?php
namespace App\Controllers;

use View, Direct, NormalController, Route, Config;


class AdminController extends Controller implements NormalController {

    
    public function index(){
        return View::make('admin');
    }
    
    public function settings(){
        $page = $this->select('pages', ['*'], ['type' => 'page'], 'page');
        return View::make('admin.settings', ['pages' => $page]);
    }
    
    public function patch_settings($data){
        $this->setSetting('frontpage', $data['frontpage']);
        return Direct::re('/admin/settings');
    }
    
    public function themes(){
        $themes = array_diff(scandir('./view/'), array('.', '..', '.DS_Store'));
        return View::make('admin.themes', ['themes' => $themes]);
    }
    
    public function patch_themes($data){
        $this->setSetting('theme', $data['theme']);
        return Direct::re('/admin/themes');
    }
    
    public function pages(){
        $types = $this->getFiles('./view/'.Config::$theme.'/view/pages');
        
        $page = $this->select('pages', ['*'], ['type' => 'page'], 'page');
        return View::make('admin.pages', ['pages' => $page, 'pagetypes' => $types]);
    }
    
    public function posts(){
        $types = $this->getFiles('./view/'.Config::$theme.'/view/posts');
        
        $blogs = $this->select('pages', ['*'], ['style' => 'blog'], 'page')->fetchAll();
        $posts = $this->select('pages', ['*'], ['type' => 'post'], 'page')->fetchAll();
        return View::make('admin.posts', ['pagetypes' => $types, 'blogs' => $blogs, 'posts' => $posts]);
    }
    
    public function getFiles($path){
        $types = array_diff(scandir($path), array('.', '..', '.DS_Store'));
        foreach($types as $key => $type){
            $types[$key] = pathinfo($type, PATHINFO_FILENAME);
        }
        return $types;
    }
    
    public function put_posts($data){
         $this->insert('pages', [[
            'header'    => $data['header'],
            'content'   => $data['content'],
            'permalink' => date('d-m-y-', time()).$this->headerToUrl($data['header']),
            'style'     => $data['style'],
            'parent'    => $data['parent'],
            'type'      => 'post',
            'visible'   => 0,
        ]]);
        
        return Direct::re('/admin/pages');
    }
    
    public function route(){
        return Route::lists();
    }
    
    public function headerToUrl($str){
        return preg_replace('/([^a-zA-Z0-9-]+)/u', '', preg_replace('/\\s/u', '-', $str));
    }
    
}
