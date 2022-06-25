<?php

namespace App\Http\Controllers;

use App\Http\Requests\OvertimeCalculateRequest;
use App\Models\Overtime;
use App\Http\Requests\StoreOvertimeRequest;
use App\Interfaces\OvertimeRepositoryInterface;

class OvertimeController extends Controller
{
    private OvertimeRepositoryInterface $overtimeRepository;

    public function __construct(OvertimeRepositoryInterface $overtimeRepository)
    {
        $this->overtimeRepository = $overtimeRepository;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOvertimeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOvertimeRequest $request)
    {
        $this->overtimeRepository->createOvertime($request->validated());
        return response()->json(['message'=>'success']);
    }
}
