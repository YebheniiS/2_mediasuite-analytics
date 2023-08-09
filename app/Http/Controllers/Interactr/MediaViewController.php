<?php
namespace App\Http\Controllers\Interactr;

use App\Http\Controllers\MetricController;
use App\Interactr\MediaView;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MediaViewController  extends MetricController
{
    protected $modelClass = MediaView::class;

    public final function add(Request $request)
    {
        try {
            $carbon = Carbon::now();

            $model = $this->modelClass::firstOrCreate([
                'api_key' => $request->apiKey,
                'date' => $carbon->format('Y-m-d'),
                'media_id' => $request->media_id,
                'project_id' => $request->project_id
            ]);

            $model->increment('count');

            $return['views'] = $model;

            return response()->json($return);

        }catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
