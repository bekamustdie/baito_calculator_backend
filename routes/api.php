<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UsersController;
use App\Http\Controllers\Api\V1\BaitoController;
use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::prefix('v1')->group(function(){
    //public
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    

    Route::middleware('auth:sanctum')->group(function(){
        Route::get('/email/verify', function () {
            return response()->json([
                'message'=>'Please verify your email'
            ], 403)->middleware('auth')->name('verification.notice');
        });
        
        //Email verification 
        Route::get('/email/verify/{id}/{hash}', [AuthController::class,'verifyEmail'])
        ->middleware('signed')
        ->name('verification.verify');

        Route::post('/logout', [AuthController::class, 'logout']);

        // Профиль
        Route::get('/profile', [UsersController::class, 'show']);
        Route::patch('/profile', [UsersController::class, 'update']);

        // Baito — кастомные роуты ПЕРЕД apiResource
        Route::get('/baitos/month/{year}/{month}', [BaitoController::class, 'getByMonth']);
        Route::get('/baitos/week/{date}',          [BaitoController::class, 'getByWeek']);
        Route::get('/baitos/day/{date}',           [BaitoController::class, 'getByDay']);
        
        
        Route::apiResource('baitos', BaitoController::class);
        Route::apiResource('work-place', BaitoController::class);
    });
});




