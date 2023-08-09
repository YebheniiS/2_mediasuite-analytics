<?php
namespace App\Http\Controllers\Interactr;

use App\Http\Controllers\MetricController;
use App\Interactr\UploadStorage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UploadStorageController extends MetricController
{
    protected $modelClass = UploadStorage::class;

    public final function add(Request $request)
    {
        try {
            $carbon = Carbon::now('UTC');

            $model = $this->modelClass::firstOrCreate([
                'api_key' => $request->apiKey,
                'project_id' => $request->project_id,
                'date' => $carbon->format('Y-m-d'),
                'user_id' => $request->user_id,
                'media_id' => $request->media_id,
                'storage_used' => $request->storage_used
            ]);

            return response()->json($model);

        }catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
