<?php

namespace App\Models;

use App\Repositories\SettingRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;

    public function referenceActive(){
        $settingRepository = new SettingRepository;
        $refernce_id = $settingRepository->getsettingByKey('overtime_method')->value;
        return $this->find($refernce_id);
    }
}
