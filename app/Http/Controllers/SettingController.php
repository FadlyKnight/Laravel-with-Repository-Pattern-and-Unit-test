<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Interfaces\SettingRepositoryInterface;

class SettingController extends Controller
{
    private SettingRepositoryInterface $settingRepository;

    public function __construct(SettingRepositoryInterface $settingRepository) 
    {
        $this->settingRepository = $settingRepository;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingRequest $request)
    {
        $this->settingRepository->updatesetting($request->key, $request->value);
        return response()->json(['message'=>'success']);
    }
}
