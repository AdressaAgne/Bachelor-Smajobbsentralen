<?php

namespace App\Controllers;

use View, NormalController, Config, Direct, Request;

//innsetillenger
class SettingsController extends Controller {

    public function opningstider(){
        return View::make('opentimes');
    }

    public function arbeidstyper(){
        return View::make('categories');
    }

    public function delete_arbeidstype(Request $data){
        return $this->deleteWhere('kategorier', 'id', $data->post->id);
    }

    public function put_arbeidstyper(Request $data){
        $this->insert('kategorier',[
            [
                'name' => $data->post->name,
                'icon' => isset($data->post->icon) ? $data->post->icon : "user"
            ]
        ]);
        
        return Direct::re('/arbeidstyper');
    }
}//class
