<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

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
        $member = $member->with('yogaClasses', "walkingClasses")->find($member->id);

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
}
