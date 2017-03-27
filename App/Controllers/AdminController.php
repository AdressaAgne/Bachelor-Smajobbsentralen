<?php
namespace App\Controllers;

use View, Direct, NormalController, Route, Config, Uploader;


class AdminController extends Controller implements NormalController {

    public $admin = true;
    
    public function index(){
        return View::make('admin', null, true);
    }
    
    public function media(){
        $media = $this->select('image', ['*'], null, 'Image')->fetchAll();
        
        return View::make('media', ['media' => $media], true);
    }
    public function put_media(){
        
        $uploader = new Uploader($_FILES['file']);
        
        return $uploader->upload();
    }
    
    public function settings(){
        $page = $this->select('pages', ['*'], ['type' => 'page'], 'page');
        return View::make('settings', ['pages' => $page], true);
    }
    
    public function patch_settings($data){
        $this->setSetting('frontpage', $data['frontpage']);
        return Direct::re('/admin/settings');
    }
    
    public function themes(){
        $themes = array_diff(scandir('./view/'), array('.', '..', '.DS_Store'));
        return View::make('themes', ['themes' => $themes], true);
    }
    
    public function patch_themes($data){
        $this->setSetting('theme', $data['theme']);
        return Direct::re('/admin/themes');
    }
    
    public function pages(){
        $types = $this->getFiles('./view/'.Config::$theme.'/view/pages');
        
        $page = $this->select('pages', ['*'], ['type' => 'page'], 'page');
        return View::make('pages', ['pages' => $page, 'pagetypes' => $types], true);
    }
    
    public function posts(){
        $types = $this->getFiles('./view/'.Config::$theme.'/view/posts');
        
        $blogs = $this->select('pages', ['*'], ['style' => 'blog'], 'page')->fetchAll();
        $posts = $this->select('pages', ['*'], ['type' => 'post'], 'page')->fetchAll();
        $media = $this->select('image', ['*'], null, 'Image')->fetchAll();
        
        return View::make('posts', ['pagetypes' => $types, 'blogs' => $blogs, 'posts' => $posts, 'media' => $media], true);
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
            'image'     => (isset($data['image']) ? $data['image'] : 1)
        ]]);
        
        return Direct::re('/admin/posts', null, true);
    }
    
    public function arrange_blogposts($data){
        $page = $this->select('pages', ['*'], ['permalink' => $data['page']], 'page')->fetch();
        
        return View::make('arrange', ['page' => $page], true);
    }
    
    public function arrange_blogposts_patch($data){
        
        $this->updatePageArray($data['posts']);

        return Direct::re("/page/arrange/".$data['page']);
    }
    
    public function route(){
        return Route::lists();
    }
    
    public function headerToUrl($str){
        return preg_replace('/([^a-zA-Z0-9-]+)/u', '', preg_replace('/\\s/u', '-', $str));
    }
    
}
