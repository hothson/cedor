<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\WalkingClass;
use Illuminate\Http\Request;

class WalkingClassController extends Controller
{
   /**
    * @SWG\Get(
    *     path="/api/walking-classes",
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
    *       		"instructor": "A001",
    *               "attendent": "22",
    *               "vitamin_D": "ddd",
    *               "started_at": "20200303",
    *               "ended_at": "20200304",
    *               "notes": "Check me",
    *               "updated_at": "2020-08-26T04:18:51.000000Z",
    *               "created_at": "2020-08-26T04:18:51.000000Z",
    *               "id": 1
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
        $walkingClass = WalkingClass::all();
        
        return response()->json($walkingClass, 200);
    }

   /**
    * @SWG\Post(
    *     path="/api/walking-classes",
    *     description="Return Json",
    *     @SWG\Parameter(
    *         name="Authorization",
    *         in="header",
    *         type="string",
    *         required=true,
    *     ),
    *      @SWG\Parameter(
    *         name="instructor",
    *         in="query",
    *         type="string",
    *         required=true,
    *     ),
    *     @SWG\Parameter(
    *         name="attendent",
    *         in="query",
    *         type="integer",
    *         required=true,
    *     ),
    *      @SWG\Parameter(
    *         name="vitamin_D",
    *         in="query",
    *         type="integer",
    *         required=false,
    *     ),
    *      @SWG\Parameter(
    *         name="started_at",
    *         in="query",
    *         type="string",
    *         required=false,
    *     ),
    *      @SWG\Parameter(
    *         name="ended_at",
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
    *               "instructor": "A001",
    *               "attendent": "22",
    *               "vitamin_D": "ddd",
    *               "started_at": "20200303",
    *               "ended_at": "20200304",
    *               "notes": "Check me",
    *               "updated_at": "2020-08-26T04:18:51.000000Z",
    *               "created_at": "2020-08-26T04:18:51.000000Z",
    *               "id": 1
    *               }
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
        $walking_class = WalkingClass::create($request->all());

        return response()->json($walking_class, 201);
    }

    /**
    * @SWG\Get(
    *     path="/api/walking-classes/{walkingClassId}",
    *     description="Return Json",
    *     @SWG\Parameter(
    *         name="walkingClassId",
    *         in="path",
    *         type="integer",
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
    *       		"instructor": "A001",
    *               "attendent": "22",
    *               "vitamin_D": "ddd",
    *               "started_at": "20200303",
    *               "ended_at": "20200304",
    *               "notes": "Check me",
    *               "updated_at": "2020-08-26T04:18:51.000000Z",
    *               "created_at": "2020-08-26T04:18:51.000000Z",
    *               "id": 1
    *     		}
    *		 }
    *     ),
    *		@SWG\Response(
    *         response=401,
    *         description="Unauthorized",
    *     ),
    * )
    */
    public function show(WalkingClass $walkingClass)
    {
        $walkingClass = $walkingClass->with('members')->find($walkingClass->id);
        return response()->json($walkingClass, 200);
    }

    /**
    * @SWG\Put(
    *     path="/api/walking-classes/{walkingClassId}",
    *     description="Return Json",
    *     @SWG\Parameter(
    *         name="Authorization",
    *         in="header",
    *         type="string",
    *         required=true,
    *     ),
    *     @SWG\Parameter(
    *         name="walkingClassId",
    *         in="path",
    *         type="integer",
    *         required=true,
    *     ),
    *      @SWG\Parameter(
    *         name="instructor",
    *         in="query",
    *         type="string",
    *         required=true,
    *     ),
    *     @SWG\Parameter(
    *         name="attendent",
    *         in="query",
    *         type="integer",
    *         required=true,
    *     ),
    *      @SWG\Parameter(
    *         name="vitamin_D",
    *         in="query",
    *         type="integer",
    *         required=false,
    *     ),
    *      @SWG\Parameter(
    *         name="started_at",
    *         in="query",
    *         type="string",
    *         required=false,
    *     ),
    *      @SWG\Parameter(
    *         name="ended_at",
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
    *               "instructor": "A001",
    *               "attendent": "22",
    *               "vitamin_D": "ddd",
    *               "started_at": "20200303",
    *               "ended_at": "20200304",
    *               "notes": "Check me",
    *               "updated_at": "2020-08-26T04:18:51.000000Z",
    *               "created_at": "2020-08-26T04:18:51.000000Z",
    *               "id": 1
    *           }
    *		 }
    *     ),
    *		@SWG\Response(
    *         response=401,
    *         description="Unauthorized",
    *     ),
    * )
    */
    public function update(Request $request, WalkingClass $walkingClass)
    {
        $walkingClass = $walkingClass->update($request->all());

        return response()->json($walkingClass, 200);
    }

    /**
    * @SWG\Delete(
    *     path="/api/walking-classes/{walkingClassId}",
    *     description="Return Json",
    *     @SWG\Parameter(
    *         name="walkingClassId",
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
    public function destroy(WalkingClass $walkingClass)
    {
        $r = $walkingClass->delete();

        return response()->json($r, 200);
    }
}
