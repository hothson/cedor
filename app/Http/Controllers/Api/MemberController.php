<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\HealthIndex;

class MemberController extends Controller
{
    /**
    * @SWG\Get(
    *     path="/api/members",
    *     description="Return Json",
    *     @SWG\Parameter(
    *         name="Authorization",
    *         in="header",
    *         type="string",
    *         required=true,
    *     ),
    *     @SWG\Response(
    *         response=200,
    *         description="OK",
    *         examples={
    *     		"application/json": {
    *       		"account_number": "A001",
    *               "name": "Son",
    *               "age": "29",
    *               "gender": "Male",
    *               "phone_number": "0921173391",
    *               "notes": "Check me",
    *               "updated_at": "2020-08-25T09:36:12.000000Z",
    *               "created_at": "2020-08-25T09:36:12.000000Z",
    *               "id": 2
    *     		}
    *		 }
    *     ),
    *		@SWG\Response(
    *         response=401,
    *         description="Unauthorized",
    *     ),
    * )
    */
    public function index()
    {
        $members = Member::all();
        
        return response()->json($members, 200);
    }

    /**
    * @SWG\Post(
    *     path="/api/members",
    *     description="Return Json",
    *     @SWG\Parameter(
    *         name="Authorization",
    *         in="header",
    *         type="string",
    *         required=true,
    *     ),
    *      @SWG\Parameter(
    *         name="account_number",
    *         in="query",
    *         type="string",
    *         required=true,
    *     ),
    *     @SWG\Parameter(
    *         name="name",
    *         in="query",
    *         type="string",
    *         required=true,
    *     ),
    *      @SWG\Parameter(
    *         name="age",
    *         in="query",
    *         type="integer",
    *         required=false,
    *     ),
    *      @SWG\Parameter(
    *         name="gender",
    *         in="query",
    *         type="string",
    *         required=false,
    *     ),
    *      @SWG\Parameter(
    *         name="phone_number",
    *         in="query",
    *         type="string",
    *         required=false,
    *     ),
    *      @SWG\Parameter(
    *         name="notes",
    *         in="query",
    *         type="string",
    *         required=false,
    *     ),
    *     @SWG\Response(
    *         response=201,
    *         description="OK",
    *         examples={
    *     		"application/json": {
    *       		"account_number": "A001",
    *               "name": "Son",
    *               "age": "29",
    *               "gender": "Male",
    *               "phone_number": "0921173391",
    *               "notes": "Check me",
    *               "updated_at": "2020-08-25T09:36:12.000000Z",
    *               "created_at": "2020-08-25T09:36:12.000000Z",
    *               "id": 2
    *     		}
    *		 }
    *     ),
    *		@SWG\Response(
    *         response=401,
    *         description="Unauthorized",
    *     ),
    * )
    */
    public function store(Request $request)
    {
        $request->validate([
            'account_number' => 'required',
            'name' => 'required'
        ]);

        $member = Member::create($request->all());

        return response()->json($member, 201);
    }

    /**
    * @SWG\Get(
    *     path="/api/members/{memberId}",
    *     description="Return Json",
    *     @SWG\Parameter(
    *         name="memberId",
    *         in="path",
    *         type="string",
    *         required=true,
    *     ),
    *     @SWG\Parameter(
    *         name="Authorization",
    *         in="header",
    *         type="string",
    *         required=true,
    *     ),
    *     @SWG\Response(
    *         response=200,
    *         description="OK",
    *         examples={
    *     		"application/json": {
    *       		"account_number": "A001",
    *               "name": "Son",
    *               "age": "29",
    *               "gender": "Male",
    *               "phone_number": "0921173391",
    *               "notes": "Check me",
    *               "updated_at": "2020-08-25T09:36:12.000000Z",
    *               "created_at": "2020-08-25T09:36:12.000000Z",
    *               "id": 2
    *     		}
    *		 }
    *     ),
    *		@SWG\Response(
    *         response=401,
    *         description="Unauthorized",
    *     ),
    * )
    */
    public function show(Member $member)
    {
        $member = $member->with('yogaClasses', "walkingClasses")
            ->with(['healthIndexes' => function ($query) {
                $query->orderBy('date', 'desc')->first();
            }])
            ->find($member->id);

        return response()->json($member, 200);
    }

   /**
    * @SWG\Put(
    *     path="/api/members/{memberId}",
    *     description="Return Boolean",
    *     @SWG\Parameter(
    *         name="memberId",
    *         in="path",
    *         type="string",
    *         required=true,
    *     ),
    *     @SWG\Parameter(
    *         name="Authorization",
    *         in="header",
    *         type="string",
    *         required=true,
    *     ),
    *      @SWG\Parameter(
    *         name="account_number",
    *         in="query",
    *         type="string",
    *         required=true,
    *     ),
    *     @SWG\Parameter(
    *         name="name",
    *         in="query",
    *         type="string",
    *         required=true,
    *     ),
    *      @SWG\Parameter(
    *         name="age",
    *         in="query",
    *         type="integer",
    *         required=false,
    *     ),
    *      @SWG\Parameter(
    *         name="gender",
    *         in="query",
    *         type="string",
    *         required=false,
    *     ),
    *      @SWG\Parameter(
    *         name="phone_number",
    *         in="query",
    *         type="string",
    *         required=false,
    *     ),
    *      @SWG\Parameter(
    *         name="notes",
    *         in="query",
    *         type="string",
    *         required=false,
    *     ),
    *     @SWG\Response(
    *         response=200,
    *         description="OK",
    *     ),
    *		@SWG\Response(
    *         response=401,
    *         description="Unauthorized",
    *     ),
    * )
    */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'account_number' => 'required',
            'name' => 'required'
        ]);
        
        $member = $member->update($request->all());

        return response()->json($member, 200);
    }

    /**
    * @SWG\Delete(
    *     path="/api/members/{memberId}",
    *     description="Return Json",
    *     @SWG\Parameter(
    *         name="memberId",
    *         in="path",
    *         type="string",
    *         required=true,
    *     ),
    *     @SWG\Parameter(
    *         name="Authorization",
    *         in="header",
    *         type="string",
    *         required=true,
    *     ),
    *     @SWG\Response(
    *         response=200,
    *         description="OK",
    *     ),
    *		@SWG\Response(
    *         response=401,
    *         description="Unauthorized",
    *     ),
    * )
    */
    public function destroy(Member $member)
    {
        $r = $member->delete();

        return response()->json($r, 200);
    }

    public function search($search)
    {
        $members = Member::where('name', 'like', "%{$search}%")->get();

        return response()->json($members, 200);
    }

    public function getHealthIndexes($memberId)
    {
        $healthIndexes = HealthIndex::where('member_id', $memberId)
            ->orderBy('date', 'asc')->get();
        
        if (empty($healthIndexes)) {
            return response()->json($healthIndexes, 200);
        }

        $rawChangingRate = $this->getrawChangingRateDatas($healthIndexes);
        $changingRatePoints = $this->getChangingPointsForEachIndex($rawChangingRate);
        
        $indexesDataPoints = $this->getDataPointsForEachIndex($healthIndexes);

        return response()->json(array(
            'indexPoints' => $indexesDataPoints,
            'changingRatePoints' => $changingRatePoints,
            'status' => 'OK'
        ), 200);
    }

    private function getrawChangingRateDatas($healthIndexes)
    {
        $beginningDate = $healthIndexes[0];
        
        foreach ($healthIndexes as $key => $healthIndex) {
            if ($key == 0) continue;
            $changingRatePoint = [
                'weight' => $this->getChangingRate($beginningDate, $healthIndex, 'weight'),
                'body_fat' => $this->getChangingRate($beginningDate, $healthIndex, 'body_fat'),
                'belly_fat' => $this->getChangingRate($beginningDate, $healthIndex, 'belly_fat'),
                'subcutaneous_fate' => $this->getChangingRate($beginningDate, $healthIndex, 'subcutaneous_fate'),
                'colon_fat' => $this->getChangingRate($beginningDate, $healthIndex, 'colon_fat'),
                'bone_muscle_mass' => $this->getChangingRate($beginningDate, $healthIndex, 'bone_muscle_mass'),
                'vitamin_D' => $this->getChangingRate($beginningDate, $healthIndex, 'vitamin_D'),
                'date' => $healthIndex['date']
            ];
            $rawChangingRate[] = $changingRatePoint;
            
        }

        return $rawChangingRate;
    }

    private function getChangingPointsForEachIndex($rawChangingRate)
    {
        foreach ($rawChangingRate as $key => $changingPointIndex) {
            $weightPoints[] = $this->getChangingPointForIndex($changingPointIndex, 'weight');
            $bodyFatPoints[] = $this->getChangingPointForIndex($changingPointIndex, 'body_fat');
            $bellyFatPoints[] = $this->getChangingPointForIndex($changingPointIndex, 'belly_fat');
            $subcutaneousFatPoints[] = $this->getChangingPointForIndex($changingPointIndex, 'subcutaneous_fate');
            $colonFatPoints[] = $this->getChangingPointForIndex($changingPointIndex, 'colon_fat');
            $boneMuscleMassPoints[] = $this->getChangingPointForIndex($changingPointIndex, 'bone_muscle_mass');
            $vitaminDPoints[] = $this->getChangingPointForIndex($changingPointIndex, 'vitamin_D');
        }

        $changingRatePoints['CR_weight'] = $weightPoints;
        $changingRatePoints['CR_body_fat'] = $bodyFatPoints;
        $changingRatePoints['CR_belly_fat'] = $bellyFatPoints;
        $changingRatePoints['CR_subcutaneous_fate'] = $subcutaneousFatPoints;
        $changingRatePoints['CR_colon_fat'] = $colonFatPoints;
        $changingRatePoints['CR_bone_muscle_mass'] = $boneMuscleMassPoints;
        $changingRatePoints['CR_vitamin_D'] = $vitaminDPoints;
        
        return $changingRatePoints;
    }

    private function getChangingPointForIndex($changingPointIndex, $key)
    {
        $point[$key] = $changingPointIndex[$key];
        $point['date'] = $changingPointIndex['date'];

        return $point;
    }

    private function getDataPointsForEachIndex($healthIndexes)
    {
        foreach ($healthIndexes as $key => $healthIndex) {
            $weightPoints[] = $this->getDataPointForIndex($healthIndex, 'weight');
            $bodyFatPoints[] = $this->getDataPointForIndex($healthIndex, 'body_fat');
            $bellyFatPoints[] = $this->getDataPointForIndex($healthIndex, 'belly_fat');
            $subcutaneousFatPoints[] = $this->getDataPointForIndex($healthIndex, 'subcutaneous_fate');
            $colonFatPoints[] = $this->getDataPointForIndex($healthIndex, 'colon_fat');
            $boneMuscleMassPoints[] = $this->getDataPointForIndex($healthIndex, 'bone_muscle_mass');
            $vitaminDPoints[] = $this->getDataPointForIndex($healthIndex, 'vitamin_D');
        }

        $indexesDataPoints['weight_index'] = $weightPoints;
        $indexesDataPoints['body_fat_index'] = $bodyFatPoints;
        $indexesDataPoints['belly_fat_index'] = $bellyFatPoints;
        $indexesDataPoints['subcutaneous_fate_index'] = $subcutaneousFatPoints;
        $indexesDataPoints['colon_fat_index'] = $colonFatPoints;
        $indexesDataPoints['bone_muscle_mass_index'] = $boneMuscleMassPoints;
        $indexesDataPoints['vitamin_D_index'] = $vitaminDPoints;
        
        return $indexesDataPoints;
    }

    private function getDataPointForIndex($healthIndex, $key)
    {
        $point[$key] = $healthIndex[$key];
        $point['date'] = $healthIndex['date'];

        return $point;
    }

    private function getChangingRate($beginningDate, $healthIndex, $key)
    {   $standard = [
            "weight" => 80,
            "body_fat" => 20,
            "belly_fat" => 20,
            "subcutaneous_fate" => 20,
            "colon_fat" => 20,
            "bone_muscle_mass" => 20,
            "vitamin_D" => 400,
        ];
        $result = ($healthIndex[$key] - $beginningDate[$key])/($standard[$key] - $beginningDate[$key]);

        return ceil($result*100);
    }
}
