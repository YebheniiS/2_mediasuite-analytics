<?php

namespace Tests\Feature;

use App\Http\Controllers\MetricController;
use Carbon\Carbon;
use Tests\TestCase;

class InteractrProjectViewTest extends TestCase
{
    public function testAdd()
    {
        $key = MetricController::APPROVED_API_KEYS['local'];
        $api = 'interactr';
        $data = [
            "project_id" => 1
        ];

        $response = $this->json('POST', "/api/$key/$api/project-view", $data);
        $response->assertStatus(200);
    }

    public function testGet()
    {
        $key = MetricController::APPROVED_API_KEYS['local'];
        $data = [
            [
                "name" => "project_id-1",
                "collection" => "ProjectView",
                "api" => "Interactr",
                "filters" => [
                    "project_id" => 1
                ],
                "start_date" => Carbon::now()->format('d-m-Y'),
                "end_date" => Carbon::now()->format('d-m-Y'),
                "group_by" => "day"
            ]
        ];
        $structure = [
            'project_id-1' => [
                [
                    "count",
                    "start_date",
                    "end_date"
                ]
            ]
        ];
        $response = $this->json('POST',"/api/$key/query", $data);

        $response->assertJsonStructure($structure);
    }
}
