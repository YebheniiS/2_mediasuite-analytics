<?php

namespace App\Http\Controllers;

use App\Metric;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MetricController extends Controller
{
    const APPROVED_API = [
        'Interactr',
    ];

    /** @var Model $class */
    protected $modelClass;

    protected final function getGroupSqlString($group)
    {
        switch ($group) {
            case('day') :
                return 'DATE_FORMAT(date, "%d-%m-%y")';
            case('month') :
                return 'DATE_FORMAT(date, "%m-%y")';
            case('year') :
                return 'DATE_FORMAT(date, "%y")';
            default:
                return $group;
        }
    }


    /**
     * Base increment method, will often be overidden in the
     * controller that extends this. Will leave here in case
     * it's needed in the future.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        try {
            $carbon = Carbon::now();

            $query = $this->modelClass::query()
                ->where('api_key', $request->apiKey)
                ->where('date', $carbon->format('Y-m-d'));

            foreach ($request->all() as $column => $value) {
                $query->where($column, $value);
            }

            $model = $query->firstOrCreate(array_merge($request->all(), [
                'api_key' => $request->apiKey,
                'date' => $carbon->format('Y-m-d')
            ]));

            $model->increment('count');

            return response()->json($model);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public final function get(Request $request)
    {
        $result = [];
        foreach ($request->all() as $requestQuery) {
            $api = $requestQuery['api'];
            $controller = "{$requestQuery['collection']}Controller";
            $className = "App\Http\Controllers\\$api\\$controller";
            if (!class_exists($className, true)) {
                return response()->json("Collection '{$requestQuery['collection']}' does not exists.", 400);
            }
            /** @var MetricController $class */
            $class = new $className();

            try {
                $result[$requestQuery['name']] = $class->query($requestQuery);
            } catch (Exception $e) {
                return response()->json($e->getMessage(), 400);
            }
        }
        return response()->json($result);
    }


    public function query(Array $requestQuery)
    {
        $projects = 
        $groupBy = (isset($requestQuery['group_by'])) ? $this->getGroupSqlString($requestQuery['group_by']) : false;

        // Select statement;
        if (isset($requestQuery['distinct'])) {
            $query = "SELECT DISTINCT {$requestQuery['distinct']}";
            $countKey = $requestQuery['distinct'];
        } else {
            $count = (isset($requestQuery['count'])) ?  '`'.$requestQuery['count'].'`' : 'count';
            $query = 'SELECT SUM('.$count.')';
            $countKey = 'SUM('.$count.')';
        }

        if ($groupBy) {
            $query .= ", $groupBy";
        }

        if (!in_array($requestQuery['api'], self::APPROVED_API)) {
            throw new Exception('API namespace is not supported.');
        }

        /** @var Metric $object */
        $object = new $this->modelClass();
        $query .= " FROM {$object->getTable()}";

        // Where (date range)
        // Reformat the to and from dates
        $from = Carbon::createFromDate($requestQuery['start_date']);
        $to = Carbon::createFromDate($requestQuery['end_date']);

        // Turn into sql as string for the DBRAW queries
        $query .= " WHERE date BETWEEN '" . $from->format('Y-m-d') . "' AND '" . $to->format('Y-m-d') . "'";

        // Where (filters)
        if (isset($requestQuery['filters'])) {
            foreach ($requestQuery['filters'] as $key => $value) {
                if(empty($value))continue;
                $query .= ' AND ' . $key;
                if (is_array($value)) {
                    $query .= ' IN (' . implode(",", $value) . ')';
                } else {
                    $query .= ' = ' . $value;
                }
            }
        }

        // group
        if ($groupBy) {
            $query .= " GROUP BY $groupBy";
        }

        if (isset($requestQuery['limit'])) {
            $query .= " LIMIT {$requestQuery['limit']}";
        }

        $result = DB::select(DB::raw($query));

        if (!$groupBy) {
            if ( $this->startsWith($countKey, 'SUM(') ) {
                return $result[0]->{$countKey};
            } else {
                $return = [];
                foreach ($result as $key => $value) {
                    $return[] = $value->{$requestQuery['distinct']};
                }
                return $return;
            }
        }

        // Make the data easier to work with in the group section
        $data = [];
        switch ($requestQuery['group_by']) {
            case('day') :
                $dateKey = 'DATE_FORMAT(date, "%d-%m-%y")';
                break;
            case('month') :
                $dateKey = 'DATE_FORMAT(date, "%m-%y")';
                break;
            case('year') :
                $dateKey = 'DATE_FORMAT(date, "%y")';
                break;
            default :
                $dateKey = $requestQuery['group_by'];
                break;
        }
        foreach ($result as $key => $value) {
            $data[$value->{$dateKey}] = $value->{$countKey};
        }

        $return = [];
        if(strpos($dateKey, 'DATE_FORMAT') !== false){

            do {
                $group = [
                    // If this group isn't set we just return it with a 0
                    'count' => (isset($data[$from->format('d-m-y')])) ? $data[$from->format('d-m-y')] : 0,
                    'start_date' => $from->format('Y-m-d'),
                ];

                $from = $from->addDays(1);
                $group['end_date'] = $from->format('Y-m-d');

                $return[] = $group;

            } while ($from <= $to);

        } else{
            $return = $data;
        }

        return $return;
    }

    // Function to check string starting
// with given substring
    function startsWith ($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }
}
