<?php

namespace App\Http\Controllers\Interactr;

use App\Interactr\StreamCredits;
use App\Http\Middleware\KeyMiddleware;
use App\Http\Middleware\UpdateKeyMiddleware;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StreamCreditsController extends Controller
{
    protected $modelClass = StreamCredits::class;

    /**
     * Increase Stream Credits
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function increase(Request $request) {
        try {
            $appEnv = strtolower(env('APP_ENV'));
            $model = $this->modelClass::firstOrCreate([
                'api_key' => KeyMiddleware::APPROVED_API_KEYS[$appEnv],
                'user_id' => $request->user_id
            ]);
    
            $model->increment('amount', $request->delta_amount);
            return response()->json($model);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Decrease Stream Credits
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function decrease(Request $request) {
        try {
            $model = $this->modelClass::firstOrCreate([
                'api_key' => $request->apiKey,
                'user_id' => $request->user_id
            ]);
            
            if($model->amount > 0) {
                $model->decrement('amount');
            }
            return response()->json($model);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

     /**
     * Get Stream Credits
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(Request $request) {
        try {
            $model = $this->modelClass::firstOrCreate([
                'api_key' => $request->apiKey,
                'user_id' => $request->user_id
            ]);
            return response()->json($model);
        } catch (Exception $e) { 
            return response()->json($e->getMessage(), 500);
        }
    }
    
    /**
     * Decrease All Stream Credits
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function decreaseAll(Request $request) {
        try {
            $appEnv = strtolower(env('APP_ENV'));
            $model = $this->modelClass::firstOrCreate([
                'api_key' => KeyMiddleware::APPROVED_API_KEYS[$appEnv],
                'user_id' => $request->user_id
            ]);
            
            $model->amount = 0;
            $model->save();

            return response()->json($model);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
