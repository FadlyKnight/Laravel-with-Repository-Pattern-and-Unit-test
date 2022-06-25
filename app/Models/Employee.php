<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name','salary'];
    protected $appends = [
        'overtime_duration_total',
        'amount'
    ];
    public function overtime(){
        return $this->hasMany(Overtime::class, 'employee_id','id');
    }

    public function getOvertimeDurationTotalAttribute(){
        return $this->overtime()->get()->sum('overtime_duration');
    } 

    public function getAmountAttribute(){
        $reference = new Reference;
        $overtime_total = $this->overtime_duration_total;
        if ($overtime_total > 0) {
            $referenceActive = $reference->referenceActive();
            $replaceSalary = str_replace('salary',$this->salary,$referenceActive->expression);
            $replaceOvertimeTotal = str_replace('overtime_duration_total', $overtime_total, $replaceSalary);
            return eval('return '.$replaceOvertimeTotal.';');
        } else {
            return 0;
        }
    }

}
