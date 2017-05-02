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

    public function edit(Request $data){
        
        foreach($data->post->from as $day => $time){
            
        }
        // $data->post->from = array_filter($data->post->from, function(&$time){
        //     return !empty($time);
        // });
        // 
        // $data->post->to = array_filter($data->post->to, function(&$time){
        //     return !empty($time);
        // });
        // 
        foreach ($data->post->to as $day => $time) {
            $this->query('INSERT INTO opningstider (day, from_time, to_time) 
            VALUES(:day, :from, :to)
            ON DUPLICATE KEY UPDATE from_time = :from, to_time = :to
            ', [
                'day' => $day+1,
                'from' => $data->post->from[$day],
                'to' => $time,
            ]);
            
        }
        
        $this->deleteWhere('opningstider', 'from_time', '');
        
        return Direct::re('/telefonvakt/opningstider');
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
        
        return Direct::re('/telefonvakt/arbeidstyper');
    }
}//class
