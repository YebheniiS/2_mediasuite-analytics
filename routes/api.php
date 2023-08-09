<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'key', 'prefix' => '/{apiKey}'], function()
{
    Route::post('query', 'MetricController@get');

    Route::group(['prefix' => '/interactr'], function()
    {
        Route::post('project-view', "Interactr\ProjectViewController@add");
        Route::post('impression', "Interactr\ImpressionController@add");
        Route::post('completion', "Interactr\CompletionController@add");
        Route::post('node-interactions', "Interactr\NodeInteractionController@add");
        Route::post('node-duration', "Interactr\NodeViewDurationController@add");
        Route::post('project-duration', "Interactr\ProjectViewDurationController@add");
        Route::post('element-click', "Interactr\ElementClickController@add");
        Route::post('element-impression', "Interactr\ElementImpressionController@add");
        Route::post('modal-view', "Interactr\ModalViewController@add");
        Route::post('media-view', "Interactr\MediaViewController@add");
        Route::post('streaming-mins', "Interactr\StreamingMinsController@add");
        Route::post('upload-storage', "Interactr\UploadStorageController@add");
        // Only Player has access to the APIs below.
        Route::post('get-mins', "Interactr\StreamCreditsController@get");
        Route::post('decrease-mins', "Interactr\StreamCreditsController@decrease");
    });
});

Route::group(['middleware' => 'update.key', 'prefix' => '/{apiKey}'], function()
{
    Route::group(['prefix' => '/interactr'], function()
    {
        // Only Interactr API has access to the APIs below.
        Route::post('increase-mins', "Interactr\StreamCreditsController@increase");
        Route::post('get-storage', "Interactr\StorageCreditsController@get");
        Route::post('increase-storage', "Interactr\StorageCreditsController@increase");
        Route::post('decrease-storage', "Interactr\StorageCreditsController@decrease");
        // Remove all credits when refunded
        Route::post('decrease-storage-all', "Interactr\StorageCreditsController@decreaseAll");
        Route::post('decrease-mins-all', "Interactr\StreamCreditsController@decreaseAll");
    });
});

