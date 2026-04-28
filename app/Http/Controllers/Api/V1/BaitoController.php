<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\PostBaitoRequest;
use App\Http\Resources\BaitoResource;
use App\Services\BaitosService;
use App\Models\Baito;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;


class BaitoController extends ApiController
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(private BaitosService  $baitosService){}

    public function index(Request $request)
    {
        $baitos = $request->user()->baito;
        return $this->success(BaitoResource::collection($baitos));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostBaitoRequest $request)
    {
        $user = $request->user();
        $baito = $user->baito()->create($request->validated());
        return $this->success(new BaitoResource($baito));
    }

    /**
     * Display the specified resource.
     */
    public function show(Baito $baito)
    { 
        Gate::authorize('view', $baito);
        return $this->success(new BaitoResource($baito));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Baito $baito, PostBaitoRequest $request)
    {
        Gate::authorize('update', $baito);
        $baito->update($request->validated());
        return $this->success(new BaitoResource($baito));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Baito $baito)
    {
        Gate::authorize('delete', $baito);
        $baito->delete();
        return $this->noContent();
    }

    public function getByMonth($year, $month){
        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();
        $baitos = Baito::where('user_id', '=', auth()->id())->whereBetween('date', [$startDate, $endDate])->get();
        return $this->success(BaitoResource::collection($baitos));

    }

    public function getByWeek($year, $month){
        $startDate = Carbon::create($year, $month, 1)->startOfWeek();
        $endDate = Carbon::create($year, $month, 1)->endOfWeek();
        $baitos = Baito::where('user_id', '=', auth()->id())->whereBetween('date', [$startDate, $endDate])->get();
        return $this->success(BaitoResource::collection($baitos));
    }

    public function getByDay($year, $month, $day){
        $startDate = Carbon::create($year, $month, 1)->startOfDay();
        $endDate = Carbon::create($year, $month, 1)->endOfDay();
        $baitos = Baito::where('user_id', '=', auth()->id())->whereBetween('date', [$startDate, $endDate])->get();
        return $this->success(BaitoResource::collection($baitos));
    }




    



}
