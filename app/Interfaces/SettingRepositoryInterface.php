<?php

namespace App\Interfaces;

interface SettingRepositoryInterface 
{
    public function getAllsettings();
    public function getsettingByKey($settingKey);
    public function updatesetting($settingKey, $settingValue);
}