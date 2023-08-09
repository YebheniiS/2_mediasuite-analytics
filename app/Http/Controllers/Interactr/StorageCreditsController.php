<?php

namespace App\Http\Controllers\Interactr;

use App\Interactr\StorageCredits;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StorageCreditsController extends Controller
{
    protected $modelClass = StorageCredits::class;

    /**
     * Increase Storage Credits
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function increase(Request $request) {
        try {
            $model = $this->modelClass::firstOrCreate([
                'api_key' => $request->apiKey,
                'user_id' => $request->user_id
            ]);

            $model->increment('amount', $request->delta_amount);
            return response()->json($model);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Decrease Storage Credits
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
            
            if($request->delta_amount > $model->amount) {
                $model->amount = 0;
                $model->save();
            } else {
                $model->decrement('amount', $request->delta_amount);
            }
            return response()->json($model);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

     /**
     * Get Storage Credits
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
     * Decrease All Storage Credits
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function decreaseAll(Request $request) {
        try {
            $model = $this->modelClass::firstOrCreate([
                'api_key' => $request->apiKey,
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