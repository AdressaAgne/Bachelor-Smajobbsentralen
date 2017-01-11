<?php
namespace App\Controllers;

use View, Direct, NormalController, Route;


class AdminController extends Controller implements NormalController {

    
    public function index(){
        
        return View::make('admin');
        
    }
    
    public function settings(){
        $settings = $this->all('settings');
        
        foreach($settings as $key => $value){
            $settings[$value['name']] = $value['value'];
            unset($settings[$key]);
        }
        
        $page = $this->select('pages', ['*'], ['parent' => null], 'page');
        
        return View::make('admin.settings', ['pages' => $page,
                                             'settings' => $settings]);
    }
    
    public function patch_settings($data){
        
        $this->updateWhere('settings', ['value' => $data['frontpage']], ['name' => 'frontpage']);
        
        return Direct::re('/admin/settings');
        
    }
    
    public function themes(){
        return View::make('admin.themes');
    }
    
    public function pages(){
        $types = ['normal', 'blog'];
        $page = $this->select('pages', ['*'], null, 'page');
        return View::make('admin.pages', ['pages' => $page, 'pagetypes' => $types]);
    }
    
    public function posts(){
        $types = ['normal'];
        $blogs = $this->select('pages', ['*'], ['style' => 'blog'], 'page')->fetchAll();
        return View::make('admin.posts', ['pagetypes' => $types, 'blogs' => $blogs]);
    }
    
    public function put_posts($data){
        
         $this->insert('pages', [[
            'header'    => $data['header'],
            'content'   => $data['content'],
            'permalink' => date('d-m-y-', time()).$this->headerToUrl($data['header']),
            'style'     => $data['style'],
            'parent'    => $data['parent'],
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
