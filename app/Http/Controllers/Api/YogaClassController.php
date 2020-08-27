<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\YogaClass;
use Illuminate\Http\Request;

class YogaClassController extends Controller
{
    /**
    * @SWG\Get(
    *     path="/api/yogaClasses",
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
        $r = YogaClass::all();
        
        return response()->json($r, 200);
    }

    /**
    * @SWG\Post(
    *     path="/api/yogaClasses",
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
        $yogaClass = YogaClass::create($request->all());

        return response()->json($yogaClass, 201);
    }

    /**
    * @SWG\Get(
    *     path="/api/yogaClasses/{yogaClassId}",
    *     description="Return Json",
    *     @SWG\Parameter(
    *         name="yogaClassId",
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
    public function show(YogaClass $yogaClass)
    {
        return response()->json($yogaClass, 200);
    }

    /**
    * @SWG\Put(
    *     path="/api/yogaClasses/{yogaClassId}",
    *     description="Return Json",
    *     @SWG\Parameter(
    *         name="Authorization",
    *         in="header",
    *         type="string",
    *         required=true,
    *     ),
    *     @SWG\Parameter(
    *         name="yogaClassId",
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
    public function update(Request $request, YogaClass $yogaClass)
    {
        $yogaClass = $yogaClass->update($request->all());

        return response()->json($yogaClass, 200);
    }

    /**
    * @SWG\Delete(
    *     path="/api/yogaClasses/{yogaClassId}",
    *     description="Return Json",
    *     @SWG\Parameter(
    *         name="yogaClassId",
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
    public function destroy(YogaClass $yogaClass)
    {
        $r = $yogaClass->delete();

        return response()->json($r, 200);
    }
}
