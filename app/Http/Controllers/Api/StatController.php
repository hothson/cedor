<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\HealthIndex;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ Carbon;

class StatController extends Controller
{
    public function index()
    {
        $avgHealthIndexes = DB::table('health_indexes')
            ->select(
                DB::raw(
                    'AVG(weight) as avg_weight,
                    AVG(body_fat) as avg_body_fat,
                    AVG(belly_fat) as avg_belly_fat,
                    AVG(subcutaneous_fate) as avg_subcutaneous_fate,
                    AVG(colon_fat) as avg_colon_fat,
                    AVG(bone_muscle_mass) as avg_bone_muscle_mass,
                    time')
            )
            ->groupBy('time')
            ->orderBy('time', 'asc')
            ->get();

        if ($avgHealthIndexes->isEmpty()) {
            return response()->json($avgHealthIndexes, 200);
        }

        $avgChangingRateRawTimes = $this->caculateChangingRate($avgHealthIndexes);
        $avgChangingRatePoints = $this->getDataPointsForAllAvgChangingRate($avgChangingRateRawTimes);

        $indexStats = $this->caculateStatsForAllIndexes($avgChangingRateRawTimes);
        
        $memberStats = $this->getMembersStat();

        return response()->json(array(
                'avgChangingRatePoints' => $avgChangingRatePoints,
                'indexStats' =>  $indexStats,
                'memberStats' =>  $memberStats,
                'status' => 200
            ), 200);
    }

    private function getMembersStat()
    {
        $total = DB::table('members')->count();

        $monthAbsenting = DB::table('members')
            ->leftJoin('member_walking', 'members.id', '=', 'member_walking.member_id')
            ->leftJoin('walking_classes', 'member_walking.walking_id', '=', 'walking_classes.id')

            ->leftJoin('member_yoga', 'members.id', '=', 'member_yoga.member_id')
            ->leftJoin('yoga_classes', 'member_yoga.yoga_id', '=', 'yoga_classes.id')

            ->select(DB::raw('members.id as member_id'))

            ->where('walking_classes.attendance', '<', Carbon::now()->subDays(30))
            ->where('yoga_classes.attendance', '<', Carbon::now()->subDays(30))
            ->groupBy('members.id')
            ->get()
            ->count();
        
        $currentMembers = DB::table('members')
            ->leftJoin('member_walking', 'members.id', '=', 'member_walking.member_id')
            ->leftJoin('walking_classes', 'member_walking.walking_id', '=', 'walking_classes.id')

            ->leftJoin('member_yoga', 'members.id', '=', 'member_yoga.member_id')
            ->leftJoin('yoga_classes', 'member_yoga.yoga_id', '=', 'yoga_classes.id')

            ->select(DB::raw('members.id as member_id'))

            ->where('walking_classes.attendance', '=', Carbon::now()->format('Y-m-d'))
            ->orWhere('yoga_classes.attendance', '=', Carbon::now()->format('Y-m-d'))
            ->groupBy('members.id')
            ->get()
            ->count();
        
        return array(
            'total' => $total,
            'monthAbsenting' => $monthAbsenting,
            "currentMembers" => $currentMembers);
    }

    private function caculateStatsForAllIndexes($avgChangingRateRawTimes)
    {
        $keys = ['avg_cr_weight', 'avg_cr_body_fat', 'avg_cr_belly_fat', 'avg_cr_subcutaneous_fate',
             'avg_cr_bone_muscle_mass'];
        
        foreach ($keys as $key) {
            $stat = $this->caculateChangingRateStat($avgChangingRateRawTimes, $key);
            $stats[$key] = $stat;
        }

        return $stats;
    }

    private function caculateChangingRateStat($avgChangingRateRawTimes, $key)
    {
        $weightArray = array_map(function($item) use ($key) {
            return $item[$key];
        }, $avgChangingRateRawTimes);

        $weightAbsArr = array_map(function($item) use ($key) {
            return abs($item[$key]);
        }, $avgChangingRateRawTimes);

        $avgWeightChangingRate = ceil(array_sum($weightArray)/count($weightArray));
        $maxWeightChangingRate = max($weightAbsArr);
        $minWeightChangingRate = min($weightAbsArr);

        $stat['avg'] = $avgWeightChangingRate;
        $stat['max'] = $maxWeightChangingRate;
        $stat['min'] = $minWeightChangingRate;
       
        return $stat;
    }

    private function getDataPointsForAllAvgChangingRate($avgChangingRateRawTimes)
    {
        foreach ($avgChangingRateRawTimes as $key => $avgChangingRateRawTime) {
            $weightPoints[] = $this->getDataPointForIndex($avgChangingRateRawTime, 'avg_cr_weight');
            $bodyFatPoints[] = $this->getDataPointForIndex($avgChangingRateRawTime, 'avg_cr_body_fat');
            $bellyFatPoints[] = $this->getDataPointForIndex($avgChangingRateRawTime, 'avg_cr_belly_fat');
            $subcutaneousFatPoints[] = $this->getDataPointForIndex($avgChangingRateRawTime, 'avg_cr_subcutaneous_fate');
            $colonFatPoints[] = $this->getDataPointForIndex($avgChangingRateRawTime, 'avg_cr_colon_fat');
            $boneMuscleMassPoints[] = $this->getDataPointForIndex($avgChangingRateRawTime, 'avg_cr_bone_muscle_mass');
        }

        $avgChangingRatePoints['avg_cr_weight'] = $weightPoints;
        $avgChangingRatePoints['avg_cr_body_fat'] = $bodyFatPoints;
        $avgChangingRatePoints['avg_cr_belly_fat'] = $bellyFatPoints;
        $avgChangingRatePoints['avg_cr_subcutaneous_fate'] = $subcutaneousFatPoints;
        $avgChangingRatePoints['avg_cr_colon_fat'] = $colonFatPoints;
        $avgChangingRatePoints['avg_cr_bone_muscle_mass'] = $boneMuscleMassPoints;
        
        return $avgChangingRatePoints;
    }

    private function getDataPointForIndex($avgChangingRateRawTime, $key)
    {
        $point[$key] = $avgChangingRateRawTime[$key];
        $point['time'] = $avgChangingRateRawTime['time'];

        return $point;
    }

    private function caculateChangingRate($avgHealthIndexes)
    {   
        $beginningPoint = (array) $avgHealthIndexes[0];

        foreach ($avgHealthIndexes as $key => $avgHealthIndex) {
            $avgHealthIndex = (array) $avgHealthIndex;

            if ($key == 0) continue;
            $changingRateTime = [
                'avg_cr_weight' => $this->getChangingRate($beginningPoint, $avgHealthIndex, 'avg_weight'),
                'avg_cr_body_fat' => $this->getChangingRate($beginningPoint, $avgHealthIndex, 'avg_body_fat'),
                'avg_cr_belly_fat' => $this->getChangingRate($beginningPoint, $avgHealthIndex, 'avg_belly_fat'),
                'avg_cr_subcutaneous_fate' => $this->getChangingRate($beginningPoint, $avgHealthIndex, 'avg_subcutaneous_fate'),
                'avg_cr_colon_fat' => $this->getChangingRate($beginningPoint, $avgHealthIndex, 'avg_colon_fat'),
                'avg_cr_bone_muscle_mass' => $this->getChangingRate($beginningPoint, $avgHealthIndex, 'avg_bone_muscle_mass'),
                'time' => $avgHealthIndex['time']
            ];
            $avgChangingRateRawTimes[] = $changingRateTime;
            
        }

        return $avgChangingRateRawTimes;
        
    }

    private function getChangingRate($beginningPoint, $avgHealthIndex, $key)
    {
        $avgStandard = config('constants.avgStandard');

        $result = ($avgHealthIndex[$key] - $beginningPoint[$key])/($avgStandard[$key] - $beginningPoint[$key]);

        return ceil($result*100);
    }

}
