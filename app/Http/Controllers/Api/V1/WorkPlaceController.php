<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\WorkPlaceRequest;
use App\Http\Resources\WorkPlaceResources;
use App\Models\WorkPlace;

class WorkPlaceController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $work_places = WorkPlace::where('user_id', '=', auth()->id())->get();
        return $this->success(WorkPlaceResources::collection($work_places));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkPlaceRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['is_active'] = true;
        $new_work_place = WorkPlace::create($data);
        return $this->success(new WorkPlaceResources($new_work_place));
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkPlace $workPlace)
    {
        return $this->success(new WorkPlaceResources($workPlace));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WorkPlaceRequest $request, WorkPlace $workPlace)
    {
        $data = $request->validated();
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
