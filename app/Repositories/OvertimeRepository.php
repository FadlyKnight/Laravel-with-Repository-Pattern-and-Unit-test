<?php

namespace App\Repositories;

use App\Interfaces\OvertimeRepositoryInterface;
use App\Models\Overtime;

class OvertimeRepository implements OvertimeRepositoryInterface 
{
    public function getAllOvertimes(){
        return Overtime::all();
    }

    public function getOvertimeById($overtimeId){
        return Overtime::find($overtimeId);
    }

    public function deleteOvertime($overtimeId){
        return $this->getOvertimeById($overtimeId)->delete();
    }

    public function createOvertime(array $overtimeDetails){
        return Overtime::create($overtimeDetails);
    }

    public function updateOvertime($overtimeId, array $newDetails){
        return $this->getOvertimeById($overtimeId)->update($newDetails);
    }
}