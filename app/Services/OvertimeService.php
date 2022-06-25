<?php

namespace App\Services;

use App\Models\Overtime;

class OvertimeService
{
    public function __construct()
    {
        $this->overtime =  new Overtime;
    }

    public function makeCalculate(){
        
    }
}