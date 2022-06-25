<?php

namespace App\Repositories;

use App\Interfaces\SettingRepositoryInterface;
use App\Models\Setting;

class SettingRepository implements SettingRepositoryInterface 
{
    public function getAllsettings(){
        return Setting::all();
    }

    public function getsettingByKey($key){
        return Setting::where('key',$key)->first();
    }

    public function updatesetting($key,$value){
        return Setting::where('key',$key)->update([
            'key' => $key,
            'value' => $value,
        ]);
    }
}