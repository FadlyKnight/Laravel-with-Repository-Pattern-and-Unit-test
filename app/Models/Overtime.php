<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "employee_id",
        "date",
        "time_started",
        "time_ended"
    ];
    
    // ACCESSOR
    protected $appends = [
        'overtime_duration'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id','id');
    }
    
    public function getOvertimeDurationAttribute(){
        $startTime = Carbon::parse($this->time_started);
        $finishTime = Carbon::parse($this->time_ended);
        
        return $finishTime->diffInHours($startTime);
    }
    
}
