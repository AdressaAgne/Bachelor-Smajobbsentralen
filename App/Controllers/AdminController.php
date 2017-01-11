<?php
namespace App\Controllers;

use View, Direct, NormalController, Route;


class AdminController extends Controller implements NormalController {

    
    public function index(){
        
        $types = ['normal', 'blog'];
        
        return View::make('admin', ['pagetypes' => $types]);
        
    }
    
    public function settings(){
        $settings = $this->all('settings');
        
        foreach($settings as $key => $value){
            $settings[$value['name']] = $value['value'];
            unset($settings[$key]);
        }
        
        $page = $this->select('pages', ['*'], null, 'page');
        
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
        $page = $this->select('pages', ['*'], null, 'page');
        return View::make('admin.pages', ['pages' => $page]);
    }
    
    public function route(){
        return Route::lists();
    }
}
