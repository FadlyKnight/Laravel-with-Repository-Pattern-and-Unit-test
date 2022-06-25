<?php

namespace App\Interfaces;

interface OvertimeRepositoryInterface 
{
    public function getAllOvertimes();
    public function getOvertimeById($overtimeId);
    public function deleteOvertime($overtimeId);
    public function createOvertime(array $overtimeDetails);
    public function updateOvertime($overtimeId, array $newDetails);
}