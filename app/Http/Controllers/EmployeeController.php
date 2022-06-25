<?php

namespace App\Http\Controllers;

use App\Http\Requests\OvertimeCalculateRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Interfaces\EmployeeRepositoryInterface;

class EmployeeController extends Controller
{
    private EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository) 
    {
        $this->employeeRepository = $employeeRepository;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        return response()->json(['message'=>'success','data' => $this->employeeRepository->createEmployee($request->only(['name','salary'])) ]);
    }
    
    /**
     * Display the result calculate overtime.
     *
     * @param  \App\Http\Requests\OvertimeCalculateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function show(OvertimeCalculateRequest $request)
    {
        $employeeWithCalculate = $this->employeeRepository->getAllEmployeesWithCalculateSalary($request->month);
        return response()->json(['message'=>'success', 'data' => $employeeWithCalculate->toArray()]);
    }
    
}
