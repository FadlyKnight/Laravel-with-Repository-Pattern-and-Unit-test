<?php

namespace App\Repositories;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface 
{
    public function getAllEmployees(){
        return Employee::all();
    }

    public function getEmployeeById($employeeId){
        return Employee::find($employeeId);
    }

    public function deleteEmployee($employeeId){
        return $this->getEmployeeById($employeeId)->delete();
    }

    public function createEmployee(array $employeeDetails){
        return Employee::create($employeeDetails);
    }

    public function updateEmployee($employeeId, array $newDetails){
        return $this->getEmployeeById($employeeId)->update($newDetails);
    }

    public function getAllEmployeesWithCalculateSalary($year_month){
        return Employee::whereHas('overtime',function($q) use($year_month)  {
            $year_month = explode('-',$year_month);
            $year = $year_month[0];
            $month = $year_month[1];
            $q->whereYear('date',$year)->whereMonth('date',$month);
        })->with(['overtime' => function($q) {
            $q->select('employee_id','time_started','time_ended','date');
        }])->get();
    }

}