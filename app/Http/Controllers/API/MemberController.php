<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

/**
* @SWG\Post(
*     path="/api/members",
*     description="Return Json",
*      @SWG\Parameter(
*         name="account_number",
*         in="body",
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
        $member = Member::create($request->all());

        return response()->json($member, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }
}
